<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
/**
 * @var \Laravel\Lumen\Routing\Router $router
 */

$router->group(['prefix' =>  'api'], function() use($router) {
    //Auth
    $router->post('login', 'TokenController@generateToken');

    $router->group(['middleware' => 'auth'], function() use($router) {
        // Series
        $router->group(['prefix' =>  'series'], function() use($router) {
            $router->get    (''     , 'SeriesController@index');
            $router->post   (''     , 'SeriesController@create');
            $router->get    ('{id}' , 'SeriesController@findById');
            $router->put    ('{id}' , 'SeriesController@update');
            $router->delete ('{id}' , 'SeriesController@destroy');

            $router->get('{serieId}/episodes', 'EpisodesController@getEpisodesBySerieId');
        });

        // Episodes
        $router->group(['prefix' =>  'episodes'], function() use($router) {
            $router->get    (''     , 'EpisodesController@index');
            $router->post   (''     , 'EpisodesController@create');
            $router->get    ('{id}' , 'EpisodesController@findById');
            $router->put    ('{id}' , 'EpisodesController@update');
            $router->delete ('{id}' , 'EpisodesController@destroy');
        });
    });
});

