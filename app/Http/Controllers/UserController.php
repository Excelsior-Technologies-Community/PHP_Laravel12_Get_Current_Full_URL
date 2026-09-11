<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();

        return view('users', [
            // URL information
            'current' => url()->current(),
            'full' => url()->full(),
            'previous' => url()->previous(),

            // Request information
            'method' => $request->method(),
            'host' => $request->getHost(),
            'path' => $request->path(),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->userAgent(),

            // Query information
            'query' => $query,
            'queryParameters' => $query,
            'queryCount' => count($query),
            'queryString' => $request->getQueryString(),

            // Request details
            'protocol' => $request->getScheme(),
            'isHttps' => $request->isSecure(),
            'isAjax' => $request->ajax(),
            'isJson' => $request->isJson(),
        ]);
    }
}