<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL Component Analyzer</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
            color: white;
            border-radius: 18px;
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
            margin-bottom: 25px;
        }

        .value {
            background: #f8f9fa;
            padding: 14px;
            border-radius: 8px;
            border: 1px solid #ddd;
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

    <div class="hero mb-4">

        <h1>🔗 URL Component Analyzer</h1>

        <p class="mb-0">
            Analyze every component of a URL.
        </p>

    </div>


    <div class="card">

        <div class="card-body">

            <form method="GET">

                <label class="form-label fw-bold">
                    Enter URL
                </label>

                <div class="input-group">

                    <input
                        type="text"
                        name="url"
                        value="{{ $inputUrl }}"
                        class="form-control"
                        placeholder="https://example.com/products?id=10#reviews"
                    >

                    <button class="btn btn-primary">
                        Analyze
                    </button>

                </div>

            </form>

        </div>

    </div>


    @if($inputUrl)

        <div class="alert {{ $isValid ? 'alert-success' : 'alert-danger' }}">

            @if($isValid)

                ✅ Valid URL

            @else

                ❌ Invalid URL

            @endif

        </div>


        <div class="card">

            <div class="card-header">
                📋 URL Components
            </div>

            <div class="card-body">

                <div class="row g-3">


                    @foreach([
                        'Scheme' => $scheme,
                        'Host' => $host,
                        'Port' => $port,
                        'User' => $user,
                        'Password' => $pass,
                        'Path' => $path,
                        'Query' => $query,
                        'Fragment' => $fragment
                    ] as $label => $value)

                        <div class="col-md-4">

                            <strong>
                                {{ $label }}
                            </strong>

                            <div class="value mt-2">
                                {{ $value ?: 'None' }}
                            </div>

                        </div>

                    @endforeach


                </div>

            </div>

        </div>


        <div class="card">

            <div class="card-header">
                📂 Path Segments
            </div>

            <div class="card-body">

                @if(count($segments))

                    @foreach($segments as $segment)

                        <span class="badge bg-primary fs-6 me-2 mb-2">
                            {{ $loop->iteration }}. {{ $segment }}
                        </span>

                    @endforeach

                @else

                    No path segments.

                @endif

            </div>

        </div>

    @endif


    <a
        href="{{ route('url.dashboard') }}"
        class="btn btn-dark"
    >
        ← Dashboard
    </a>

</div>

</body>

</html>
