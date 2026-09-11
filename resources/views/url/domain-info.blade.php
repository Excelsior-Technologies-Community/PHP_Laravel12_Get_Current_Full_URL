<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Domain Information</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #0dcaf0, #0d6efd);
            color: white;
            border-radius: 18px;
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
        }

        .value {
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 14px;
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

        <h1>🌐 Domain Information</h1>

        <p class="mb-0">
            Inspect host, domain, subdomain and extension.
        </p>

    </div>


    <div class="card mb-4">

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
                    placeholder="https://blog.example.com:8080/products"
                >

                <button class="btn btn-primary mt-3">
                    Analyze Domain
                </button>

            </form>

        </div>

    </div>


    <div class="card">

        <div class="card-header">
            🌐 Domain Details
        </div>

        <div class="card-body">

            <div class="row g-3">


                <div class="col-md-4">

                    <strong>Host</strong>

                    <div class="value mt-2">
                        {{ $host ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Domain</strong>

                    <div class="value mt-2">
                        {{ $domain ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Subdomain</strong>

                    <div class="value mt-2">
                        {{ $subdomain ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Extension</strong>

                    <div class="value mt-2">
                        {{ $extension ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Scheme</strong>

                    <div class="value mt-2">
                        {{ $scheme ?: 'None' }}
                    </div>

                </div>


                <div class="col-md-4">

                    <strong>Port</strong>

                    <div class="value mt-2">
                        {{ $port ?: 'Default' }}
                    </div>

                </div>


            </div>

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
