<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Route Information</title>

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
            background: linear-gradient(135deg, #0dcaf0, #6610f2);
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
                    href="{{ route('query.inspector') }}"
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
                    class="btn btn-danger btn-sm">
                    Request Inspector
                </a>

            </div>

        </div>

    </nav>


    <div class="container py-4">


        <!-- Hero -->

        <div class="hero">

            <h1>

                🛣️ Route Information Dashboard

            </h1>

            <p class="mb-0">

                Inspect the current Laravel route, URI, controller
                and route parameters.

            </p>

        </div>


        <!-- Route Information -->

        <div class="card info-card">

            <div class="card-header">

                🛣️ Current Route Details

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">

                        <tbody>


                            <tr>

                                <th width="30%">

                                    Route Name

                                </th>

                                <td>

                                    @if($routeName)

                                    <span class="badge bg-primary fs-6">

                                        {{ $routeName }}

                                    </span>

                                    @else

                                    <span class="text-muted">

                                        Route is not named

                                    </span>

                                    @endif

                                </td>

                            </tr>


                            <tr>

                                <th>

                                    Route URI

                                </th>

                                <td>

                                    <code>

                                        {{ $routeUri ?? 'N/A' }}

                                    </code>

                                </td>

                            </tr>


                            <tr>

                                <th>

                                    HTTP Method

                                </th>

                                <td>

                                    <span class="badge bg-success">

                                        {{ $method }}

                                    </span>

                                </td>

                            </tr>


                            <tr>

                                <th>

                                    Controller / Action

                                </th>

                                <td>

                                    <div class="value-box">

                                        {{ $routeAction ?? 'N/A' }}

                                    </div>

                                </td>

                            </tr>


                            <tr>

                                <th>

                                    Current Path

                                </th>

                                <td>

                                    <code>

                                        {{ $path }}

                                    </code>

                                </td>

                            </tr>


                            <tr>

                                <th>

                                    Route Parameters

                                </th>

                                <td>

                                    @if(count($routeParameters) > 0)

                                    <div class="value-box">

                                        {{ json_encode($routeParameters) }}

                                    </div>

                                    @else

                                    <span class="text-muted">

                                        No route parameters found.

                                    </span>

                                    @endif

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <!-- URL Comparison -->

        <div class="card info-card">

            <div class="card-header">

                🔗 URL Information

            </div>

            <div class="card-body">


                <div class="mb-3">

                    <strong>

                        Current URL

                    </strong>

                    <div class="value-box mt-2">

                        {{ $currentUrl }}

                    </div>

                </div>


                <div class="mb-3">

                    <strong>

                        Full URL

                    </strong>

                    <div class="value-box mt-2">

                        {{ $fullUrl }}

                    </div>

                </div>


                <div>

                    <strong>

                        Previous URL

                    </strong>

                    <div class="value-box mt-2">

                        {{ $previousUrl }}

                    </div>

                </div>

            </div>

        </div>


        <!-- Laravel Route Cheat Sheet -->

        <div class="card info-card">

            <div class="card-header">

                📚 Route Cheat Sheet

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-striped">

                        <thead>

                            <tr>

                                <th>Information</th>

                                <th>Laravel Code</th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>Current Route</td>

                                <td>

                                    <code>Route::current()</code>

                                </td>

                            </tr>

                            <tr>

                                <td>Route Name</td>

                                <td>

                                    <code>Route::current()->getName()</code>

                                </td>

                            </tr>

                            <tr>

                                <td>Route URI</td>

                                <td>

                                    <code>Route::current()->uri()</code>

                                </td>

                            </tr>

                            <tr>

                                <td>Route Action</td>

                                <td>

                                    <code>Route::current()->getActionName()</code>

                                </td>

                            </tr>

                            <tr>

                                <td>Route Parameters</td>

                                <td>

                                    <code>Route::current()->parameters()</code>

                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


    </div>


</body>

</html>