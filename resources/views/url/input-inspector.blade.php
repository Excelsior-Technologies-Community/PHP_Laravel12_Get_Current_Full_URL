<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Request Input Inspector</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #fd7e14, #dc3545);
            color: white;
            border-radius: 18px;
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
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

        <h1>📥 Request Input Inspector</h1>

        <p class="mb-0">
            Inspect query parameters and request input.
        </p>

    </div>


    <div class="card">

        <div class="card-header">
            📊 Request Summary
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4">

                    <strong>Method</strong>

                    <div class="mt-2">
                        <span class="badge bg-success">
                            {{ $method }}
                        </span>
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Path</strong>

                    <div class="mt-2">
                        {{ $path }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Input Count</strong>

                    <div class="mt-2 fs-4 fw-bold text-primary">
                        {{ $inputCount }}
                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="card mt-4">

        <div class="card-header">
            📥 All Request Input
        </div>

        <div class="card-body">

            @if(count($allInput))

                <pre class="bg-dark text-white p-3 rounded">{{ json_encode($allInput, JSON_PRETTY_PRINT) }}</pre>

            @else

                <div class="alert alert-warning">
                    No request input found.
                </div>

            @endif

        </div>

    </div>


    <div class="card mt-4">

        <div class="card-header">
            🧩 Query Input
        </div>

        <div class="card-body">

            @if(count($queryInput))

                <table class="table table-bordered">

                    <thead class="table-dark">

                        <tr>
                            <th>Parameter</th>
                            <th>Value</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach($queryInput as $key => $value)

                            <tr>

                                <td>
                                    <strong>{{ $key }}</strong>
                                </td>

                                <td>
                                    {{ is_array($value) ? json_encode($value) : $value }}
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="alert alert-warning mb-0">
                    No query input found.
                </div>

            @endif

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
