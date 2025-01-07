<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\OrganizationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/organizations/building/{buildingId}', [OrganizationController::class, 'indexByBuilding']);
Route::get('/organizations/activity/{activityId}', [OrganizationController::class, 'indexByActivity']);
Route::get('/organizations/radius', [OrganizationController::class, 'indexByRadius']);
Route::get('/organizations/{id}', [OrganizationController::class, 'show']);
Route::get('/organizations/search/{name}', [OrganizationController::class, 'searchByName']);
Route::get('/buildings', [BuildingController::class, 'index']);
Route::get('/activities', [ActivityController::class, 'index']);
