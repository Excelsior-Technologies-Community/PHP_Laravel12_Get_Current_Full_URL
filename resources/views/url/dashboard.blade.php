<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Laravel URL Inspector</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .hero {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            border-radius: 18px;
            padding: 35px;
            margin-bottom: 25px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
            margin-bottom: 25px;
        }

        .card-header {
            background: white;
            font-weight: 700;
            padding: 18px;
            border-radius: 16px 16px 0 0;
        }

        .value-box {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 12px;
            word-break: break-all;
        }

        .stat-card {
            height: 100%;
        }

        .stat-title {
            color: #6c757d;
            font-size: 14px;
        }

        .stat-value {
            font-size: 25px;
            font-weight: 700;
            margin-top: 5px;
        }

        .tool-card {
            height: 100%;
        }

        .tool-icon {
            font-size: 30px;
        }

        code {
            word-break: break-all;
        }

    </style>

</head>


<body>


<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            href="{{ route('url.dashboard') }}"
            class="navbar-brand"
        >
            🔎 Laravel URL Inspector
        </a>

        <div>

            <a
                href="{{ route('url.dashboard') }}"
                class="btn btn-light btn-sm me-1"
            >
                Dashboard
            </a>

            <a
                href="{{ route('query.inspector') }}"
                class="btn btn-warning btn-sm me-1"
            >
                Query
            </a>

            <a
                href="{{ route('route.info') }}"
                class="btn btn-info btn-sm me-1"
            >
                Route
            </a>

            <a
                href="{{ route('request.inspector') }}"
                class="btn btn-danger btn-sm"
            >
                Request
            </a>

        </div>

    </div>

</nav>


<div class="container py-4">


    <!-- Hero -->

    <div class="hero">

        <h1>
            🔎 URL & Request Dashboard
        </h1>

        <p class="mb-3">
            Inspect, analyze, validate and build Laravel URLs.
        </p>

        <button
            type="button"
            class="btn btn-light"
            onclick="copyText('{{ $fullUrl }}')"
        >
            📋 Copy Full URL
        </button>

        <span
            id="copyMessage"
            class="ms-2"
        ></span>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-4">


        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">
                        HTTP Method
                    </div>

                    <div class="stat-value">

                        <span class="badge bg-success">
                            {{ $method }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">
                        Protocol
                    </div>

                    <div class="stat-value text-primary">
                        {{ strtoupper($scheme) }}
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">
                        Query Parameters
                    </div>

                    <div class="stat-value text-success">
                        {{ $queryParameterCount }}
                    </div>

                </div>

            </div>

        </div>


        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">
                        URL Length
                    </div>

                    <div class="stat-value text-danger">
                        {{ $urlLength }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- URL Information -->

    <div class="card">

        <div class="card-header">
            🔗 URL Information
        </div>

        <div class="card-body">

            <div class="mb-3">

                <strong>Current URL</strong>

                <div class="value-box mt-2">
                    {{ $currentUrl }}
                </div>

            </div>


            <div class="mb-3">

                <strong>Full URL</strong>

                <div class="value-box mt-2">
                    {{ $fullUrl }}
                </div>

            </div>


            <div>

                <strong>Previous URL</strong>

                <div class="value-box mt-2">
                    {{ $previousUrl }}
                </div>

            </div>

        </div>

    </div>


    <!-- Feature 1 -->

    <div class="card">

        <div class="card-header">
            🔗 URL Component Analyzer
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">

                    <strong>Scheme</strong>

                    <div class="value-box mt-2">
                        {{ $scheme }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Host</strong>

                    <div class="value-box mt-2">
                        {{ $urlHost }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Port</strong>

                    <div class="value-box mt-2">
                        {{ $port }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Path</strong>

                    <div class="value-box mt-2">
                        {{ $urlPath }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Query</strong>

                    <div class="value-box mt-2">
                        {{ $urlQuery ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Fragment</strong>

                    <div class="value-box mt-2">
                        {{ $fragment ?: 'None' }}
                    </div>

                </div>

            </div>

            <div class="mt-3">

                <a
                    href="{{ route('url.analyzer') }}"
                    class="btn btn-primary"
                >
                    Open Full Analyzer
                </a>

            </div>

        </div>

    </div>


    <!-- Feature 5 -->

    <div class="card">

        <div class="card-header">
            📂 Path Segment Analyzer
        </div>

        <div class="card-body">

            @if($pathSegmentCount > 0)

                <p>
                    Total path segments:
                    <strong>{{ $pathSegmentCount }}</strong>
                </p>

                <div class="row g-3">

                    @foreach($pathSegments as $segment)

                        <div class="col-md-3">

                            <div class="alert alert-primary mb-0">

                                Segment {{ $loop->iteration }}

                                <strong class="d-block mt-1">
                                    {{ $segment }}
                                </strong>

                            </div>

                        </div>

                    @endforeach

                </div>

            @else

                <div class="alert alert-warning mb-0">
                    No path segments found.
                </div>

            @endif

        </div>

    </div>


    <!-- Request Information -->

    <div class="card">

        <div class="card-header">
            📡 Request Information
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered mb-0">

                    <tbody>

                        <tr>
                            <th width="30%">Request URL</th>
                            <td>{{ $requestUrl }}</td>
                        </tr>

                        <tr>
                            <th>Request Full URL</th>
                            <td>{{ $requestFullUrl }}</td>
                        </tr>

                        <tr>
                            <th>Method</th>
                            <td>
                                <span class="badge bg-success">
                                    {{ $method }}
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <th>Host</th>
                            <td>{{ $host }}</td>
                        </tr>

                        <tr>
                            <th>Path</th>
                            <td>
                                <code>{{ $path }}</code>
                            </td>
                        </tr>

                        <tr>
                            <th>IP Address</th>
                            <td>
                                {{ $ipAddress ?? 'Unknown' }}
                            </td>
                        </tr>

                        <tr>
                            <th>User Agent</th>
                            <td>
                                {{ $userAgent ?? 'Unknown' }}
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Feature 7 -->

    <div class="card">

        <div class="card-header">
            📥 Request Input Inspector
        </div>

        <div class="card-body">

            <p>
                Total input values:
                <strong>{{ $inputCount }}</strong>
            </p>

            @if($inputCount > 0)

                <pre class="bg-dark text-white p-3 rounded">{{ json_encode($requestInput, JSON_PRETTY_PRINT) }}</pre>

            @else

                <div class="alert alert-warning mb-0">
                    No request input detected.
                </div>

            @endif

            <a
                href="{{ route('input.inspector') }}"
                class="btn btn-primary mt-3"
            >
                Open Input Inspector
            </a>

        </div>

    </div>


    <!-- Feature 8 -->

    <div class="card">

        <div class="card-header">
            🔎 Header Search
        </div>

        <div class="card-body">

            <form
                action="{{ route('header.search') }}"
                method="GET"
                class="row g-2"
            >

                <div class="col-md-10">

                    <input
                        type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search headers, e.g. Accept, User-Agent"
                    >

                </div>

                <div class="col-md-2">

                    <button class="btn btn-primary w-100">
                        Search
                    </button>

                </div>

            </form>

        </div>

    </div>


    <!-- Feature 9 -->

    <div class="card">

        <div class="card-header">
            📊 URL Statistics
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-3">

                    <div class="alert alert-primary">

                        URL Length

                        <strong class="d-block fs-4">
                            {{ $urlLength }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="alert alert-success">

                        Query Count

                        <strong class="d-block fs-4">
                            {{ $queryParameterCount }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="alert alert-info">

                        Path Depth

                        <strong class="d-block fs-4">
                            {{ $pathSegmentCount }}
                        </strong>

                    </div>

                </div>


                <div class="col-md-3">

                    <div class="alert alert-warning">

                        Query Length

                        <strong class="d-block fs-4">
                            {{ $queryStringLength }}
                        </strong>

                    </div>

                </div>

            </div>

            <a
                href="{{ route('url.statistics') }}"
                class="btn btn-dark"
            >
                Open Statistics
            </a>

        </div>

    </div>


    <!-- All 10 Tools -->

    <div class="card">

        <div class="card-header">
            🚀 URL Tools
        </div>

        <div class="card-body">

            <div class="row g-4">


                <!-- 1 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                🔗
                            </div>

                            <h5>
                                URL Analyzer
                            </h5>

                            <p class="text-muted">
                                Analyze URL components.
                            </p>

                            <a
                                href="{{ route('url.analyzer') }}"
                                class="btn btn-primary"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 2 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                🧩
                            </div>

                            <h5>
                                Query Builder
                            </h5>

                            <p class="text-muted">
                                Build URLs with query parameters.
                            </p>

                            <a
                                href="{{ route('query.builder') }}"
                                class="btn btn-primary"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 3 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                🔐
                            </div>

                            <h5>
                                URL Encoder
                            </h5>

                            <p class="text-muted">
                                Encode and decode URL text.
                            </p>

                            <a
                                href="{{ route('url.encoder') }}"
                                class="btn btn-primary"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 4 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                ✅
                            </div>

                            <h5>
                                URL Validator
                            </h5>

                            <p class="text-muted">
                                Validate a URL.
                            </p>

                            <a
                                href="{{ route('url.validator') }}"
                                class="btn btn-success"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 5 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                📂
                            </div>

                            <h5>
                                Path Analyzer
                            </h5>

                            <p class="text-muted">
                                Analyze URL path segments.
                            </p>

                            <a
                                href="{{ route('url.analyzer') }}"
                                class="btn btn-primary"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 6 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                🌐
                            </div>

                            <h5>
                                Domain Information
                            </h5>

                            <p class="text-muted">
                                Inspect host and domain information.
                            </p>

                            <a
                                href="{{ route('domain.info') }}"
                                class="btn btn-info"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 7 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                📥
                            </div>

                            <h5>
                                Input Inspector
                            </h5>

                            <p class="text-muted">
                                Inspect request input.
                            </p>

                            <a
                                href="{{ route('input.inspector') }}"
                                class="btn btn-primary"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 8 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                🔎
                            </div>

                            <h5>
                                Header Search
                            </h5>

                            <p class="text-muted">
                                Search request headers.
                            </p>

                            <a
                                href="{{ route('header.search') }}"
                                class="btn btn-warning"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 9 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                📊
                            </div>

                            <h5>
                                URL Statistics
                            </h5>

                            <p class="text-muted">
                                Analyze URL statistics.
                            </p>

                            <a
                                href="{{ route('url.statistics') }}"
                                class="btn btn-dark"
                            >
                                Open
                            </a>

                        </div>

                    </div>

                </div>


                <!-- 10 -->

                <div class="col-md-4">

                    <div class="card tool-card border">

                        <div class="card-body">

                            <div class="tool-icon">
                                📋
                            </div>

                            <h5>
                                Copy Current URL
                            </h5>

                            <p class="text-muted">
                                Copy the current full URL.
                            </p>

                            <button
                                onclick="copyText('{{ $fullUrl }}')"
                                class="btn btn-secondary"
                            >
                                Copy URL
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Existing Navigation -->

    <div class="card">

        <div class="card-header">
            🚀 Existing Inspectors
        </div>

        <div class="card-body">

            <a
                href="{{ route('query.inspector') }}?page=2&status=active&category=laravel"
                class="btn btn-warning me-2 mb-2"
            >
                🧩 Query Inspector
            </a>

            <a
                href="{{ route('route.info') }}"
                class="btn btn-info me-2 mb-2"
            >
                🛣️ Route Information
            </a>

            <a
                href="{{ route('request.inspector') }}"
                class="btn btn-danger me-2 mb-2"
            >
                🔐 Request Inspector
            </a>

            <a
                href="{{ route('users.index') }}?page=2&status=active"
                class="btn btn-dark mb-2"
            >
                👤 Users Example
            </a>

        </div>

    </div>


</div>


<footer class="text-center text-muted py-4">

    Laravel 12 URL & Request Inspector

</footer>


<script>

function copyText(text) {

    navigator.clipboard.writeText(text)
        .then(function () {

            const message =
                document.getElementById('copyMessage');

            if (message) {

                message.innerHTML =
                    '<span class="badge bg-success">Copied!</span>';

                setTimeout(function () {

                    message.innerHTML = '';

                }, 2000);
            }

        })
        .catch(function () {

            alert('Unable to copy URL.');

        });

}

</script>


</body>

</html>
