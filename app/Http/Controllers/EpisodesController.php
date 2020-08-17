<?php

namespace App\Http\Controllers;

use App\Models\Episode;

/**
 * Class EpisodesController
 *
 * @package App\Http\Controllers
 */
class EpisodesController extends BaseController
{
    /**
     * Create new instace of controller
     *
     * @return void
     */
    public function __construct()
    {
        $this->className = Episode::class;
    }

    /**
     * Get all episodes of a serie
     *
     * @param int $serieId
     * @return Response
     */
    public function getEpisodesBySerieId(int $serieId)
    {
        $episodes = Episode::query()
            ->where('serie_id', $serieId)
            ->paginate();

        return response()->json($episodes, 200);
    }
}
