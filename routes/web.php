<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UrlInspectorController;

Route::get('/', [UrlInspectorController::class, 'dashboard']);


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

Route::get('/url-tools', [UrlInspectorController::class, 'tools'])
    ->name('url.tools');
Route::post('/url-tools/slug', [UrlInspectorController::class, 'slug'])->name('url.slug');
Route::post('/url-tools/shorten', [UrlInspectorController::class, 'shorten'])->name('url.shorten');
Route::get('/s/{code}', [UrlInspectorController::class, 'redirectShortUrl'])->name('url.short');
Route::post('/url-tools/query', [UrlInspectorController::class, 'queryTools'])->name('url.query-tools');
Route::post('/url-tools/pagination', [UrlInspectorController::class, 'pagination'])->name('url.pagination');
Route::post('/url-tools/signed', [UrlInspectorController::class, 'signed'])->name('url.signed');
Route::post('/url-tools/signed/verify', [UrlInspectorController::class, 'verifySigned'])->name('url.signed.verify');
Route::get('/url-tools/signed/{destination}', [UrlInspectorController::class, 'signedDestination'])->name('url.signed.destination');
Route::post('/url-tools/redirect-chain', [UrlInspectorController::class, 'redirectChain'])->name('url.redirect-chain');
Route::post('/url-tools/compare', [UrlInspectorController::class, 'compare'])->name('url.compare');
Route::post('/url-tools/audit', [UrlInspectorController::class, 'audit'])->name('url.audit');
Route::post('/url-tools/export', [UrlInspectorController::class, 'export'])->name('url.export');


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

