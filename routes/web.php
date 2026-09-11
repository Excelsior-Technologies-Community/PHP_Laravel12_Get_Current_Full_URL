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
| Existing URL Inspector
|--------------------------------------------------------------------------
*/

Route::get('/url-dashboard', [UrlInspectorController::class, 'dashboard'])
    ->name('url.dashboard');

Route::get('/query-inspector', [UrlInspectorController::class, 'queryInspector'])
    ->name('query.inspector');

Route::get('/route-info', [UrlInspectorController::class, 'routeInfo'])
    ->name('route.info');

Route::get('/request-inspector', [UrlInspectorController::class, 'requestInspector'])
    ->name('request.inspector');


/*
|--------------------------------------------------------------------------
| New Feature 1
| URL Component Analyzer
|--------------------------------------------------------------------------
*/

Route::get('/url-analyzer', [UrlInspectorController::class, 'analyzer'])
    ->name('url.analyzer');


/*
|--------------------------------------------------------------------------
| New Feature 2
| Query Builder
|--------------------------------------------------------------------------
*/

Route::match(
    ['get', 'post'],
    '/query-builder',
    [UrlInspectorController::class, 'queryBuilder']
)->name('query.builder');


/*
|--------------------------------------------------------------------------
| New Feature 3
| URL Encoder / Decoder
|--------------------------------------------------------------------------
*/

Route::get('/url-encoder', [UrlInspectorController::class, 'encoder'])
    ->name('url.encoder');


/*
|--------------------------------------------------------------------------
| New Feature 4
| URL Validator
|--------------------------------------------------------------------------
*/

Route::get('/url-validator', [UrlInspectorController::class, 'validator'])
    ->name('url.validator');


/*
|--------------------------------------------------------------------------
| New Feature 5
| Path Segment Analyzer
|--------------------------------------------------------------------------
|
| This is displayed directly inside the URL Analyzer.
|
*/


/*
|--------------------------------------------------------------------------
| New Feature 6
| Domain Information
|--------------------------------------------------------------------------
*/

Route::get('/domain-info', [UrlInspectorController::class, 'domainInfo'])
    ->name('domain.info');


/*
|--------------------------------------------------------------------------
| New Feature 7
| Request Input Inspector
|--------------------------------------------------------------------------
*/

Route::match(
    ['get', 'post'],
    '/input-inspector',
    [UrlInspectorController::class, 'inputInspector']
)->name('input.inspector');


/*
|--------------------------------------------------------------------------
| New Feature 8
| Header Search
|--------------------------------------------------------------------------
*/

Route::get('/header-search', [UrlInspectorController::class, 'headerSearch'])
    ->name('header.search');


/*
|--------------------------------------------------------------------------
| New Feature 9
| URL Statistics
|--------------------------------------------------------------------------
*/

Route::get('/url-statistics', [UrlInspectorController::class, 'statistics'])
    ->name('url.statistics');


/*
|--------------------------------------------------------------------------
| New Feature 10
| One-click URL Copy
|--------------------------------------------------------------------------
|
| Copy functionality is implemented with JavaScript
| on the dashboard.
|
*/

