<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL Validator</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #198754, #20c997);
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

        <h1>✅ URL Validator</h1>

        <p class="mb-0">
            Check whether a URL is syntactically valid.
        </p>

    </div>


    <div class="card">

        <div class="card-body">

            <form method="GET">

                <label class="form-label fw-bold">
                    URL
                </label>

                <input
                    type="text"
                    name="url"
                    value="{{ $inputUrl }}"
                    class="form-control"
                    placeholder="https://example.com"
                >

                <button class="btn btn-success mt-3">
                    Validate URL
                </button>

            </form>

        </div>

    </div>


    @if($inputUrl !== '')

        <div class="card mt-4">

            <div class="card-body">

                @if($isValid)

                    <div class="alert alert-success mb-0">

                        <h4>✅ Valid URL</h4>

                        <p class="mb-0">
                            The entered value is a valid URL.
                        </p>

                    </div>

                @else

                    <div class="alert alert-danger mb-0">

                        <h4>❌ Invalid URL</h4>

                        <p class="mb-0">
                            The entered value is not a valid URL.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    @endif


    <a
        href="{{ route('url.dashboard') }}"
        class="btn btn-dark mt-4"
    >
        ← Dashboard
    </a>

</div>

</body>

</html>
