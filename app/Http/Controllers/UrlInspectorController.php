<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class UrlInspectorController extends Controller
{
    /**
     * URL & Request Dashboard
     */
    public function dashboard(Request $request)
    {
        return view('url.dashboard', [

            /*
            |--------------------------------------------------------------------------
            | URL Information
            |--------------------------------------------------------------------------
            */

            'currentUrl' => url()->current(),

            'fullUrl' => url()->full(),

            'previousUrl' => url()->previous(),

            /*
            |--------------------------------------------------------------------------
            | Request Information
            |--------------------------------------------------------------------------
            */

            'requestUrl' => $request->url(),

            'requestFullUrl' => $request->fullUrl(),

            'method' => $request->method(),

            'host' => $request->getHost(),

            'path' => $request->path(),

            'ipAddress' => $request->ip(),

            'userAgent' => $request->userAgent(),
        ]);
    }


    /**
     * Query Parameter Inspector
     */
    public function queryInspector(Request $request)
    {
        $queryParameters = $request->query();

        return view('url.query-inspector', [

            /*
            |--------------------------------------------------------------------------
            | URL Information
            |--------------------------------------------------------------------------
            */

            'currentUrl' => url()->current(),

            'fullUrl' => url()->full(),

            'previousUrl' => url()->previous(),

            /*
            |--------------------------------------------------------------------------
            | Query Information
            |--------------------------------------------------------------------------
            */

            'queryParameters' => $queryParameters,

            'queryParameterCount' => count($queryParameters),

            'queryString' => $request->getQueryString(),

            /*
            |--------------------------------------------------------------------------
            | Request Information
            |--------------------------------------------------------------------------
            */

            'method' => $request->method(),

            'path' => $request->path(),
        ]);
    }


    /**
     * Route Information Dashboard
     */
    public function routeInfo(Request $request)
    {
        $currentRoute = Route::current();

        return view('url.route-info', [

            /*
            |--------------------------------------------------------------------------
            | Route Information
            |--------------------------------------------------------------------------
            */

            'routeName' => $currentRoute?->getName(),

            'routeUri' => $currentRoute?->uri(),

            'routeAction' => $currentRoute?->getActionName(),

            'routeParameters' => $currentRoute?->parameters(),

            /*
            |--------------------------------------------------------------------------
            | URL Information
            |--------------------------------------------------------------------------
            */

            'currentUrl' => url()->current(),

            'fullUrl' => url()->full(),

            'previousUrl' => url()->previous(),

            /*
            |--------------------------------------------------------------------------
            | Request Information
            |--------------------------------------------------------------------------
            */

            'method' => $request->method(),

            'path' => $request->path(),
        ]);
    }


    /**
     * Request Headers & Security Inspector
     */
    public function requestInspector(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Request Headers
        |--------------------------------------------------------------------------
        */

        $headers = $request->headers->all();

        /*
        |--------------------------------------------------------------------------
        | Security Information
        |--------------------------------------------------------------------------
        */

        $isHttps = $request->isSecure();

        $isAjax = $request->ajax();

        $isJson = $request->expectsJson();

        /*
        |--------------------------------------------------------------------------
        | Client Information
        |--------------------------------------------------------------------------
        */

        $ipAddress = $request->ip();

        $host = $request->getHost();

        $method = $request->method();

        $protocol = $request->getScheme();

        $userAgent = $request->userAgent();

        /*
        |--------------------------------------------------------------------------
        | Selected Important Headers
        |--------------------------------------------------------------------------
        */

        $acceptHeader = $request->header('Accept');

        $contentType = $request->header('Content-Type');

        $referer = $request->header('Referer');

        $xRequestedWith = $request->header('X-Requested-With');

        return view('url.request-inspector', [

            /*
            |--------------------------------------------------------------------------
            | Header Information
            |--------------------------------------------------------------------------
            */

            'headers' => $headers,

            'headerCount' => count($headers),

            /*
            |--------------------------------------------------------------------------
            | Security Information
            |--------------------------------------------------------------------------
            */

            'isHttps' => $isHttps,

            'isAjax' => $isAjax,

            'isJson' => $isJson,

            /*
            |--------------------------------------------------------------------------
            | Client Information
            |--------------------------------------------------------------------------
            */

            'ipAddress' => $ipAddress,

            'host' => $host,

            'method' => $method,

            'protocol' => $protocol,

            'userAgent' => $userAgent,

            /*
            |--------------------------------------------------------------------------
            | Important Headers
            |--------------------------------------------------------------------------
            */

            'acceptHeader' => $acceptHeader,

            'contentType' => $contentType,

            'referer' => $referer,

            'xRequestedWith' => $xRequestedWith,
        ]);
    }
}