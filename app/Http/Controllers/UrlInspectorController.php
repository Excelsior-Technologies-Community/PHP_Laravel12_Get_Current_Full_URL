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
        $currentUrl = url()->current();
        $fullUrl = url()->full();

        $parsedUrl = parse_url($fullUrl);

        $path = $request->path();

        $pathSegments = array_values(
            array_filter(explode('/', trim($path, '/')))
        );

        $queryParameters = $request->query();

        $headers = $request->headers->all();

        return view('url.dashboard', [

            // URL information
            'currentUrl' => $currentUrl,
            'fullUrl' => $fullUrl,
            'previousUrl' => url()->previous(),

            // Request information
            'requestUrl' => $request->url(),
            'requestFullUrl' => $request->fullUrl(),
            'method' => $request->method(),
            'host' => $request->getHost(),
            'path' => $path,
            'ipAddress' => $request->ip(),
            'userAgent' => $request->userAgent(),

            // Feature 1 - URL Component Analyzer
            'scheme' => $parsedUrl['scheme'] ?? $request->getScheme(),
            'urlHost' => $parsedUrl['host'] ?? $request->getHost(),
            'port' => $parsedUrl['port'] ?? $request->getPort(),
            'urlPath' => $parsedUrl['path'] ?? '/',
            'urlQuery' => $parsedUrl['query'] ?? '',
            'fragment' => $parsedUrl['fragment'] ?? '',

            // Feature 5 - Path Segment Analyzer
            'pathSegments' => $pathSegments,
            'pathSegmentCount' => count($pathSegments),

            // Feature 7 - Request Input Inspector
            'requestInput' => $request->all(),
            'inputCount' => count($request->all()),

            // Feature 8 - Header Search
            'headers' => $headers,
            'headerCount' => count($headers),

            // Feature 9 - URL Statistics
            'queryParameterCount' => count($queryParameters),
            'queryStringLength' => strlen($request->getQueryString() ?? ''),
            'urlLength' => strlen($fullUrl),
            'isHttps' => $request->isSecure(),
        ]);
    }


    /**
     * Query Parameter Inspector
     */
    public function queryInspector(Request $request)
    {
        $queryParameters = $request->query();

        return view('url.query-inspector', [

            'currentUrl' => url()->current(),

            'fullUrl' => url()->full(),

            'previousUrl' => url()->previous(),

            'queryParameters' => $queryParameters,

            'queryParameterCount' => count($queryParameters),

            'queryString' => $request->getQueryString(),

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

            'routeName' => $currentRoute?->getName(),

            'routeUri' => $currentRoute?->uri(),

            'routeAction' => $currentRoute?->getActionName(),

            'routeParameters' => $currentRoute?->parameters(),

            'currentUrl' => url()->current(),

            'fullUrl' => url()->full(),

            'previousUrl' => url()->previous(),

            'method' => $request->method(),

            'path' => $request->path(),

        ]);
    }


    /**
     * Request Headers & Security Inspector
     */
    public function requestInspector(Request $request)
    {
        $headers = $request->headers->all();

        $isHttps = $request->isSecure();

        $isAjax = $request->ajax();

        $isJson = $request->expectsJson();

        $ipAddress = $request->ip();

        $host = $request->getHost();

        $method = $request->method();

        $protocol = $request->getScheme();

        $userAgent = $request->userAgent();

        $acceptHeader = $request->header('Accept');

        $contentType = $request->header('Content-Type');

        $referer = $request->header('Referer');

        $xRequestedWith = $request->header('X-Requested-With');

        return view('url.request-inspector', [

            'headers' => $headers,

            'headerCount' => count($headers),

            'isHttps' => $isHttps,

            'isAjax' => $isAjax,

            'isJson' => $isJson,

            'ipAddress' => $ipAddress,

            'host' => $host,

            'method' => $method,

            'protocol' => $protocol,

            'userAgent' => $userAgent,

            'acceptHeader' => $acceptHeader,

            'contentType' => $contentType,

            'referer' => $referer,

            'xRequestedWith' => $xRequestedWith,

        ]);
    }


    /**
     * Feature 1
     * URL Component Analyzer
     */
    public function analyzer(Request $request)
    {
        $inputUrl = $request->input('url', url()->full());

        $parsed = parse_url($inputUrl);

        $path = $parsed['path'] ?? '';

        $segments = array_values(
            array_filter(explode('/', trim($path, '/')))
        );

        return view('url.analyzer', [

            'inputUrl' => $inputUrl,

            'isValid' => filter_var($inputUrl, FILTER_VALIDATE_URL) !== false,

            'scheme' => $parsed['scheme'] ?? null,

            'host' => $parsed['host'] ?? null,

            'port' => $parsed['port'] ?? null,

            'user' => $parsed['user'] ?? null,

            'pass' => $parsed['pass'] ?? null,

            'path' => $parsed['path'] ?? null,

            'query' => $parsed['query'] ?? null,

            'fragment' => $parsed['fragment'] ?? null,

            'segments' => $segments,

        ]);
    }


    /**
     * Feature 2
     * Query Builder
     */
    public function queryBuilder(Request $request)
    {
        $baseUrl = $request->input('base_url');

        $parameters = $request->input('parameters', []);

        $parameters = array_filter(
            $parameters,
            fn ($value) => $value !== null && $value !== ''
        );

        $generatedUrl = null;

        if ($baseUrl) {
            $generatedUrl = rtrim($baseUrl, '?&');

            if (!empty($parameters)) {
                $generatedUrl .= '?' . http_build_query($parameters);
            }
        }

        return view('url.query-builder', [

            'baseUrl' => $baseUrl,

            'parameters' => $parameters,

            'generatedUrl' => $generatedUrl,

        ]);
    }


    /**
     * Feature 3
     * URL Encoder / Decoder
     */
    public function encoder(Request $request)
    {
        $text = $request->input('text', '');

        $encoded = $text !== ''
            ? urlencode($text)
            : '';

        $decoded = $text !== ''
            ? urldecode($text)
            : '';

        return view('url.encoder', [

            'text' => $text,

            'encoded' => $encoded,

            'decoded' => $decoded,

        ]);
    }


    /**
     * Feature 4
     * URL Validator
     */
    public function validator(Request $request)
    {
        $inputUrl = $request->input('url', '');

        $isValid = false;

        if ($inputUrl !== '') {
            $isValid = filter_var(
                $inputUrl,
                FILTER_VALIDATE_URL
            ) !== false;
        }

        return view('url.validator', [

            'inputUrl' => $inputUrl,

            'isValid' => $isValid,

        ]);
    }


    /**
     * Feature 6
     * Domain Information
     */
    public function domainInfo(Request $request)
    {
        $inputUrl = $request->input('url', url()->full());

        $parsed = parse_url($inputUrl);

        $host = $parsed['host'] ?? '';

        $parts = $host !== ''
            ? explode('.', $host)
            : [];

        $extension = count($parts) >= 2
            ? '.' . end($parts)
            : '';

        $domain = count($parts) >= 2
            ? $parts[count($parts) - 2] . $extension
            : $host;

        $subdomain = count($parts) > 2
            ? implode('.', array_slice($parts, 0, -2))
            : '';

        return view('url.domain-info', [

            'inputUrl' => $inputUrl,

            'host' => $host,

            'domain' => $domain,

            'subdomain' => $subdomain,

            'extension' => $extension,

            'scheme' => $parsed['scheme'] ?? '',

            'port' => $parsed['port'] ?? '',

        ]);
    }


    /**
     * Feature 7
     * Request Input Inspector
     */
    public function inputInspector(Request $request)
    {
        return view('url.input-inspector', [

            'allInput' => $request->all(),

            'queryInput' => $request->query(),

            'path' => $request->path(),

            'method' => $request->method(),

            'inputCount' => count($request->all()),

        ]);
    }


    /**
     * Feature 8
     * Header Search
     */
    public function headerSearch(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        $headers = $request->headers->all();

        if ($search !== '') {

            $headers = array_filter(
                $headers,
                function ($values, $key) use ($search) {

                    if (
                        stripos($key, $search) !== false
                    ) {
                        return true;
                    }

                    foreach ($values as $value) {

                        if (
                            stripos($value, $search) !== false
                        ) {
                            return true;
                        }
                    }

                    return false;

                },
                ARRAY_FILTER_USE_BOTH
            );
        }

        return view('url.header-search', [

            'search' => $search,

            'headers' => $headers,

            'headerCount' => count($headers),

        ]);
    }


    /**
     * Feature 9
     * URL Statistics
     */
    public function statistics(Request $request)
    {
        $fullUrl = url()->full();

        $queryParameters = $request->query();

        $pathSegments = array_values(
            array_filter(
                explode(
                    '/',
                    trim($request->path(), '/')
                )
            )
        );

        return view('url.statistics', [

            'urlLength' => strlen($fullUrl),

            'queryCount' => count($queryParameters),

            'queryLength' => strlen(
                $request->getQueryString() ?? ''
            ),

            'pathLength' => strlen(
                $request->path()
            ),

            'pathDepth' => count($pathSegments),

            'isHttps' => $request->isSecure(),

            'method' => $request->method(),

            'host' => $request->getHost(),

            'protocol' => $request->getScheme(),

        ]);
    }
}

