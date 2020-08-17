<?php

namespace App\Http\Controllers;

use App\Models\Serie;

/**
 * Class EpisodesController
 *
 * @package App\Http\Controllers
 */
class SeriesController extends BaseController
{
    /**
     * Create new instace of controller
     *
     * @return void
     */
    public function __construct()
    {
        $this->className = Serie::class;
    }
}
