<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL Encoder Decoder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #6f42c1, #d63384);
            color: white;
            border-radius: 18px;
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
        }

        textarea {
            min-height: 150px;
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

        <h1>🔐 URL Encoder / Decoder</h1>

        <p class="mb-0">
            Encode and decode URL text.
        </p>

    </div>


    <div class="card">

        <div class="card-body">

            <form method="GET">

                <label class="form-label fw-bold">
                    Text / URL
                </label>

                <textarea
                    name="text"
                    class="form-control"
                    placeholder="hello world?name=John Doe"
                >{{ $text }}</textarea>


                <button class="btn btn-primary mt-3">
                    Process
                </button>

            </form>

        </div>

    </div>


    @if($text !== '')

        <div class="card mt-4">

            <div class="card-header">
                🔐 Encoded
            </div>

            <div class="card-body">

                <div class="alert alert-primary">
                    {{ $encoded }}
                </div>

            </div>

        </div>


        <div class="card mt-4">

            <div class="card-header">
                🔓 Decoded
            </div>

            <div class="card-body">

                <div class="alert alert-success">
                    {{ $decoded }}
                </div>

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
