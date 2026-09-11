<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Users URL Example</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
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
            margin-bottom: 20px;
        }

        .value {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 14px;
            border-radius: 8px;
            word-break: break-all;
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

    <div class="hero">

        <h1>👤 Users URL Example</h1>

        <p class="mb-0">
            Test Laravel URL and request information using the /users route.
        </p>

    </div>


    <div class="card">

        <div class="card-header fw-bold">
            🔗 URL Information
        </div>

        <div class="card-body">

            <p class="fw-bold mb-2">Current URL</p>

            <div class="value mb-3">
                {{ $current }}
            </div>


            <p class="fw-bold mb-2">Full URL</p>

            <div class="value mb-3">
                {{ $full }}
            </div>


            <p class="fw-bold mb-2">Previous URL</p>

            <div class="value">
                {{ $previous }}
            </div>

        </div>

    </div>


    <div class="card">

        <div class="card-header fw-bold">
            📡 Request Information
        </div>

        <div class="card-body">

            <table class="table table-bordered">

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
                    <td>{{ $path }}</td>
                </tr>

            </table>

        </div>

    </div>


    <div class="card">

        <div class="card-header fw-bold">
            🧩 Query Parameters
        </div>

        <div class="card-body">

            @if(count($query))

                @foreach($query as $key => $value)

                    <div class="mb-2">

                        <strong>{{ $key }}</strong>:

                        {{ is_array($value) ? json_encode($value) : $value }}

                    </div>

                @endforeach

            @else

                <div class="alert alert-warning mb-0">
                    No query parameters found.
                </div>

            @endif

        </div>

    </div>


    <a
        href="{{ route('url.dashboard') }}"
        class="btn btn-primary"
    >
        ← Back to Dashboard
    </a>

</div>

</body>

</html>
