<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Query Parameter Inspector</title>

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
            background: linear-gradient(135deg, #198754, #0d6efd);
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

        .stat-number {
            font-size: 32px;
            font-weight: 700;
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

                🧩 Query Parameter Inspector

            </h1>

            <p class="mb-0">

                Inspect and understand URL query parameters using Laravel Request.

            </p>

        </div>


        <!-- Statistics -->

        <div class="card info-card mb-4">

            <div class="card-body">

                <div class="row">


                    <div class="col-md-4">

                        <div class="text-muted">

                            Total Parameters

                        </div>

                        <div class="stat-number text-primary">

                            {{ $queryParameterCount }}

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="text-muted">

                            HTTP Method

                        </div>

                        <div class="mt-2">

                            <span class="badge bg-success fs-6">

                                {{ $method }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="text-muted">

                            Current Path

                        </div>

                        <div class="mt-2 fw-bold">

                            {{ $path }}

                        </div>

                    </div>


                </div>

            </div>

        </div>


        <!-- Full URL -->

        <div class="card info-card">

            <div class="card-header">

                🔗 Current Full URL

            </div>

            <div class="card-body">

                <div class="value-box">

                    {{ $fullUrl }}

                </div>

            </div>

        </div>


        <!-- Query Parameters -->

        <div class="card info-card">

            <div class="card-header">

                📋 Detected Query Parameters

            </div>

            <div class="card-body">


                @if($queryParameterCount > 0)

                <div class="alert alert-success">

                    <strong>

                        {{ $queryParameterCount }}

                    </strong>

                    query parameter(s) detected successfully.

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">

                            <tr>

                                <th width="10%">#</th>

                                <th width="35%">Parameter</th>

                                <th>Value</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($queryParameters as $key => $value)

                            <tr>

                                <td>

                                    {{ $loop->iteration }}

                                </td>

                                <td>

                                    <strong>

                                        {{ $key }}

                                    </strong>

                                </td>

                                <td>

                                    @if(is_array($value))

                                    {{ json_encode($value) }}

                                    @else

                                    {{ $value }}

                                    @endif

                                </td>

                            </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

                @else

                <div class="alert alert-warning">

                    No query parameters were found.

                </div>

                @endif

            </div>

        </div>


        <!-- Query String -->

        <div class="card info-card">

            <div class="card-header">

                📝 Raw Query String

            </div>

            <div class="card-body">

                <div class="value-box">

                    @if($queryString)

                    ?{{ $queryString }}

                    @else

                    No query string found.

                    @endif

                </div>

            </div>

        </div>


        <!-- Test URL -->

        <div class="card info-card">

            <div class="card-header">

                🧪 Try Another Example

            </div>

            <div class="card-body">

                <p>

                    Test Laravel query parameter handling with:

                </p>

                <a
                    href="{{ route('query.inspector') }}?page=5&status=pending&sort=latest"
                    class="btn btn-primary">
                    Test Query Parameters
                </a>

            </div>

        </div>


    </div>


</body>

</html>