<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Models\ShortUrl;

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

    public function tools()
    {
        return view('url.tools');
    }

    public function slug(Request $request)
    {
        $text = (string) $request->input('text', '');
        $slug = trim(preg_replace('/[^a-z0-9]+/i', '-', strtolower($text)), '-');

        return view('url.tools', compact('text', 'slug'));
    }

    public function shorten(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
        ]);

        $shortUrl = ShortUrl::create([
            'code' => substr(str_replace(['+', '/', '='], '', base64_encode(random_bytes(9))), 0, 10),
            'url' => $data['url'],
        ]);

        return view('url.tools', compact('shortUrl'));
    }

    public function redirectShortUrl(string $code)
    {
        $shortUrl = ShortUrl::where('code', $code)->firstOrFail();

        return redirect()->away($shortUrl->url);
    }

    public function queryTools(Request $request)
    {
        $baseUrl = (string) $request->input('base_url', '');
        $parameters = array_values(array_filter($request->input('parameters', []), fn ($parameter) =>
            filled($parameter['key'] ?? null)
        ));
        $generatedUrl = $baseUrl !== ''
            ? rtrim($baseUrl, '?&') . (count($parameters) ? '?' . http_build_query(array_column($parameters, 'value', 'key')) : '')
            : '';

        return view('url.tools', compact('baseUrl', 'parameters', 'generatedUrl'));
    }

    public function pagination(Request $request)
    {
        $data = $request->validate([
            'url' => ['required', 'url', 'max:2048'],
            'page' => ['required', 'integer', 'min:1'],
            'limit' => ['required', 'integer', 'min:1'],
        ]);
        $generatedUrl = $data['url'] . (str_contains($data['url'], '?') ? '&' : '?') . http_build_query([
            'page' => $data['page'],
            'limit' => $data['limit'],
        ]);

        return view('url.tools', compact('generatedUrl'));
    }

    public function signed(Request $request)
    {
        $destination = $request->input('url', url('/url-tools'));
        $expires = now()->addMinutes((int) $request->input('minutes', 30));
        $signedUrl = URL::temporarySignedRoute('url.signed.destination', $expires, [
            'destination' => rtrim(strtr(base64_encode($destination), '+/', '-_'), '='),
        ]);

        return view('url.tools', compact('signedUrl'));
    }

    public function signedDestination(Request $request)
    {
        abort_unless($request->hasValidSignature(), 403);

        return redirect()->away(base64_decode(strtr($request->route('destination'), '-_', '+/')));
    }

    public function verifySigned(Request $request)
    {
        $signedUrl = (string) $request->input('signed_url', '');
        $signedRequest = Request::create($signedUrl);

        return view('url.tools', [
            'verificationResult' => $signedUrl !== '' && URL::hasValidSignature($signedRequest),
        ]);
    }

    public function redirectChain(Request $request)
    {
        $url = (string) $request->input('url', '');
        $chain = $url !== '' ? $this->followRedirects($url) : [];

        return view('url.tools', compact('chain'));
    }

    public function compare(Request $request)
    {
        $firstUrl = (string) $request->input('first_url', '');
        $secondUrl = (string) $request->input('second_url', '');

        return view('url.tools', [
            'comparison' => $this->compareUrls($firstUrl, $secondUrl),
        ]);
    }

    public function audit(Request $request)
    {
        $url = (string) $request->input('url', '');
        $audit = $this->auditUrl($url);

        return view('url.tools', compact('audit'));
    }

    public function export(Request $request)
    {
        $audit = $this->auditUrl((string) $request->input('url', ''));

        if ($request->input('format') === 'csv') {
            $csv = "key,value\n";
            foreach ($audit as $key => $value) {
                $csv .= sprintf("%s,%s\n", $key, str_replace(["\r", "\n", '"'], ['', '', '""'], (string) $value));
            }

            return response($csv, 200, ['Content-Type' => 'text/csv', 'Content-Disposition' => 'attachment; filename="url-audit.csv"']);
        }

        return response()->json($audit, 200, ['Content-Disposition' => 'attachment; filename="url-audit.json"']);
    }

    private function followRedirects(string $url): array
    {
        $chain = [];

        for ($step = 0; $step < 10 && filter_var($url, FILTER_VALIDATE_URL); $step++) {
            try {
                $response = Http::timeout(5)->withOptions(['allow_redirects' => false])->get($url);
            } catch (\Throwable $exception) {
                $chain[] = ['url' => $url, 'status' => 'error', 'location' => $exception->getMessage()];
                break;
            }

            $location = $response->header('Location');
            $chain[] = ['url' => $url, 'status' => $response->status(), 'location' => $location];
            if (!$location) {
                break;
            }
            $url = $this->resolveUrl($url, $location);
        }

        return $chain;
    }

    private function resolveUrl(string $baseUrl, string $location): string
    {
        if (filter_var($location, FILTER_VALIDATE_URL)) {
            return $location;
        }

        $base = parse_url($baseUrl);
        $origin = ($base['scheme'] ?? 'https') . '://' . ($base['host'] ?? '');

        return str_starts_with($location, '/')
            ? $origin . $location
            : $origin . '/' . ltrim(dirname($base['path'] ?? '/') . '/' . $location, '/');
    }

    private function compareUrls(string $firstUrl, string $secondUrl): array
    {
        $first = parse_url($firstUrl) ?: [];
        $second = parse_url($secondUrl) ?: [];
        $keys = ['scheme', 'host', 'port', 'path', 'query', 'fragment'];

        return collect($keys)->mapWithKeys(fn ($key) => [$key => [
            'first' => $first[$key] ?? '',
            'second' => $second[$key] ?? '',
            'same' => ($first[$key] ?? '') === ($second[$key] ?? ''),
        ]])->all();
    }

    private function auditUrl(string $url): array
    {
        $parsed = parse_url($url) ?: [];
        $query = [];
        parse_str($parsed['query'] ?? '', $query);

        return [
            'url' => $url,
            'valid' => filter_var($url, FILTER_VALIDATE_URL) !== false,
            'scheme' => $parsed['scheme'] ?? '',
            'host' => $parsed['host'] ?? '',
            'path' => $parsed['path'] ?? '/',
            'query' => $parsed['query'] ?? '',
            'fragment' => $parsed['fragment'] ?? '',
            'query_count' => count($query),
            'slug' => trim(preg_replace('/[^a-z0-9]+/i', '-', strtolower($parsed['path'] ?? '')), '-'),
            'length' => strlen($url),
            'redirect_chain' => json_encode($this->followRedirects($url)),
        ];
    }
}

