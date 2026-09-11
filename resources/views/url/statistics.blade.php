<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL Statistics</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #212529, #495057);
            color: white;
            border-radius: 18px;
            padding: 35px;
        }

        .stat-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
            height: 100%;
        }

        .number {
            font-size: 30px;
            font-weight: 700;
        }

    </style>

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            href="{{ route('url.dashboard') }}"
            class="navbar-brand fw-bold"
        >
            🔎 Laravel URL Inspector
        </a>

    </div>

</nav>


<div class="container py-4">

    <div class="hero mb-4">

        <h1>📊 URL Statistics</h1>

        <p class="mb-0">
            Statistics for the current Laravel request URL.
        </p>

    </div>


    <div class="row g-4">


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        URL Length
                    </div>

                    <div class="number text-primary">
                        {{ $urlLength }}
                    </div>

                    <small>
                        characters
                    </small>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        Query Parameters
                    </div>

                    <div class="number text-success">
                        {{ $queryCount }}
                    </div>

                    <small>
                        parameters
                    </small>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        Query String Length
                    </div>

                    <div class="number text-warning">
                        {{ $queryLength }}
                    </div>

                    <small>
                        characters
                    </small>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        Path Length
                    </div>

                    <div class="number text-info">
                        {{ $pathLength }}
                    </div>

                    <small>
                        characters
                    </small>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        Path Depth
                    </div>

                    <div class="number text-danger">
                        {{ $pathDepth }}
                    </div>

                    <small>
                        segments
                    </small>

                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="text-muted">
                        HTTPS
                    </div>

                    <div class="number">

                        @if($isHttps)

                            <span class="text-success">
                                YES
                            </span>

                        @else

                            <span class="text-danger">
                                NO
                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="card mt-4">

        <div class="card-header">
            📡 Request Details
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>

                    <th>
                        Method
                    </th>

                    <td>
                        <span class="badge bg-success">
                            {{ $method }}
                        </span>
                    </td>

                </tr>

                <tr>

                    <th>
                        Host
                    </th>

                    <td>
                        {{ $host }}
                    </td>

                </tr>

                <tr>

                    <th>
                        Protocol
                    </th>

                    <td>
                        {{ strtoupper($protocol) }}
                    </td>

                </tr>

            </table>

        </div>

    </div>


    <a
        href="{{ route('url.dashboard') }}"
        class="btn btn-dark mt-4"
    >
        ← Dashboard
    </a>

</div>

</body>

</html>
