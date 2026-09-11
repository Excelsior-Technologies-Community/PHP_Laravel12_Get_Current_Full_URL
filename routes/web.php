<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UrlInspectorController;


/*
|--------------------------------------------------------------------------
| Original URL Example
|--------------------------------------------------------------------------
*/

Route::get('/users', [UserController::class, 'index'])
    ->name('users.index');


/*
|--------------------------------------------------------------------------
| URL & Request Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/url-dashboard', [UrlInspectorController::class, 'dashboard'])
    ->name('url.dashboard');


/*
|--------------------------------------------------------------------------
| Query Parameter Inspector
|--------------------------------------------------------------------------
*/

Route::get('/query-inspector', [UrlInspectorController::class, 'queryInspector'])
    ->name('query.inspector');


/*
|--------------------------------------------------------------------------
| Route Information Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/route-info', [UrlInspectorController::class, 'routeInfo'])
    ->name('route.info');


/*
|--------------------------------------------------------------------------
| Request Headers & Security Inspector
|--------------------------------------------------------------------------
*/

Route::get('/request-inspector', [UrlInspectorController::class, 'requestInspector'])
    ->name('request.inspector');