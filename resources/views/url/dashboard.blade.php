<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL & Request Dashboard</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

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

        .info-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            margin-bottom: 25px;
        }

        .info-card .card-header {
            background: white;
            border-bottom: 1px solid #eee;
            border-radius: 16px 16px 0 0;
            padding: 18px 20px;
            font-weight: 700;
        }

        .value-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
            word-break: break-all;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
        }

        .stat-title {
            color: #6c757d;
            font-size: 14px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            margin-top: 5px;
        }

        .table {
            margin-bottom: 0;
        }

        code {
            word-break: break-all;
        }

        footer {
            text-align: center;
            color: #6c757d;
            padding: 25px 0;
        }
    </style>

</head>


<body>


    <!-- Navbar -->

    <nav class="navbar navbar-dark bg-dark">

        <div class="container">

            <a
                href="{{ route('url.dashboard') }}"
                class="navbar-brand">
                🔎 Laravel URL Inspector
            </a>


            <div>

                <a
                    href="{{ route('url.dashboard') }}"
                    class="btn btn-light btn-sm me-1">
                    Dashboard
                </a>

                <a
                    href="{{ route('query.inspector') }}?page=2&status=active&category=laravel"
                    class="btn btn-warning btn-sm me-1">
                    Query Inspector
                </a>

                <a
                    href="{{ route('route.info') }}"
                    class="btn btn-info btn-sm">
                    Route Info
                </a>

                <a
                    href="{{ route('request.inspector') }}"
                    class="btn btn-danger ms-2">
                    Request Inspector
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

            <p class="mb-0">

                Inspect Laravel Current URL, Full URL, Previous URL
                and Request information.

            </p>

        </div>


        <!-- Statistics -->

        <div class="row g-4 mb-4">


            <div class="col-md-4">

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


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body">

                        <div class="stat-title">

                            Request Host

                        </div>

                        <div class="stat-value">

                            {{ $host }}

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-md-4">

                <div class="card stat-card">

                    <div class="card-body">

                        <div class="stat-title">

                            Request IP

                        </div>

                        <div class="stat-value">

                            {{ $ipAddress ?? 'Unknown' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- URL Information -->

        <div class="card info-card">

            <div class="card-header">

                🔗 URL Information

            </div>

            <div class="card-body">


                <div class="mb-4">

                    <label class="fw-bold mb-2">

                        Current URL

                    </label>

                    <div class="value-box">

                        {{ $currentUrl }}

                    </div>

                </div>


                <div class="mb-4">

                    <label class="fw-bold mb-2">

                        Full URL

                    </label>

                    <div class="value-box">

                        {{ $fullUrl }}

                    </div>

                </div>


                <div>

                    <label class="fw-bold mb-2">

                        Previous URL

                    </label>

                    <div class="value-box">

                        {{ $previousUrl }}

                    </div>

                </div>

            </div>

        </div>


        <!-- Request Information -->

        <div class="card info-card">

            <div class="card-header">

                📡 Request Information

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <tbody>

                            <tr>

                                <th width="25%">Request URL</th>

                                <td>

                                    {{ $requestUrl }}

                                </td>

                            </tr>

                            <tr>

                                <th>Request Full URL</th>

                                <td>

                                    {{ $requestFullUrl }}

                                </td>

                            </tr>

                            <tr>

                                <th>HTTP Method</th>

                                <td>

                                    <span class="badge bg-success">

                                        {{ $method }}

                                    </span>

                                </td>

                            </tr>

                            <tr>

                                <th>Host</th>

                                <td>

                                    {{ $host }}

                                </td>

                            </tr>

                            <tr>

                                <th>Path</th>

                                <td>

                                    <code>

                                        {{ $path }}

                                    </code>

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


        <!-- Navigation -->

        <div class="card info-card">

            <div class="card-header">

                🚀 Explore More

            </div>

            <div class="card-body">

                <a
                    href="{{ route('query.inspector') }}?page=2&status=active&category=laravel"
                    class="btn btn-primary me-2">
                    🧩 Query Parameter Inspector
                </a>

                <a
                    href="{{ route('route.info') }}"
                    class="btn btn-info">
                    🛣️ Route Information
                </a>

                <a
                    href="{{ route('request.inspector') }}"
                    class="btn btn-danger ms-2">
                    🔐 Request Inspector
                </a>

            </div>

        </div>


    </div>


    <footer>

        Laravel 12 URL & Request Inspector

    </footer>


</body>

</html>