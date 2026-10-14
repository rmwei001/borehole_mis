<?php

use App\Http\Controllers\LocationController;
use App\Http\Controllers\PlotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/save_location', [LocationController::class, 'createLocation']);
Route::get('/get_locations', [LocationController::class, 'readLocations']);
Route::get('/get_location/{id}', [LocationController::class, 'readLocation']);
Route::post('/update_location/{id}', [LocationController::class, 'updateLocation']);
Route::delete('/delete_location/{id}', [LocationController::class, 'deleteLocation']);
Route::get('/search_location/{name}', [LocationController::class, 'searchLocation']);

Route::post('/save_plot',[PlotController::class, 'createPlot']);
Route::get('/get_plots', [PlotController::class, 'readAllPlots']);
Route::get('get_plot/{id}', [PlotController::class, 'readPlot']);
Route::post('/update_plot/{id}', [PlotController::class, 'updatePlot']);
Route::delete('/delete_plot/{id}', [PlotController::class, 'deletePlot']);
Route::get('search_location/{name}', [PlotController::class, 'searchPlot']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
