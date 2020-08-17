<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * abstract class BaseController
 *
 * @package App\Http\Controller
 * @property protected string $className
 */
abstract class BaseController extends Controller
{
    protected string $className;

    /**
     * Return a list of resource
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return response()->json(
            $this->className::paginate($request->per_page),
            200
        );
    }

    /**
     * Create a new resource
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return response()->json($this->className::create($request->all()), 201);
    }

    /**
     * Retrieve the resource for the given ID.
     *
     * @param int $id
     * @return Response
     */
    public function findById(int $id)
    {
        $resource = $this->className::find($id);

        if(is_null($resource)) {
            return response()->json('', 204);
        }

        return response()->json($resource, 200);
    }

    /**
     * Update the specific resource
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, int $id)
    {
        try {
            $resource = $this->className::find($id);

            if(is_null($resource)) {
                return response()->json([ 'error' => 'Record not found' ], 404);
            }

            $resource->fill($request->all());
            $resource->save();

            return response()->json($resource, 200);
        } catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage() ], 500);
        }
    }

    /**
     * Destroy a resource
     *
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $qtResourcesDestroyeds = $this->className::destroy($id);

        if($qtResourcesDestroyeds === 0) {
            return response()->json([ 'error' => 'Record not found' ], 404);
        }

        return response()->json('', 204);
    }
}
