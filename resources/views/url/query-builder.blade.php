<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>URL Query Builder</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #198754, #0d6efd);
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

        <h1>🧩 Query Builder</h1>

        <p class="mb-0">
            Build a URL using query parameters.
        </p>

    </div>


    <div class="card">

        <div class="card-body">

            <form method="POST">

                @csrf


                <div class="mb-3">

                    <label class="form-label fw-bold">
                        Base URL
                    </label>

                    <input
                        type="text"
                        name="base_url"
                        class="form-control"
                        value="{{ $baseUrl }}"
                        placeholder="https://example.com/products"
                        required
                    >

                </div>


                <div class="row g-3">


                    <div class="col-md-6">

                        <label class="form-label">
                            Parameter 1
                        </label>

                        <div class="input-group">

                            <input
                                type="text"
                                name="parameters[page]"
                                class="form-control"
                                placeholder="page"
                            >

                            <input
                                type="text"
                                name="parameters[status]"
                                class="form-control"
                                placeholder="status"
                            >

                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="form-label">
                            Parameter 2
                        </label>

                        <div class="input-group">

                            <input
                                type="text"
                                name="parameters[sort]"
                                class="form-control"
                                placeholder="sort"
                            >

                            <input
                                type="text"
                                name="parameters[category]"
                                class="form-control"
                                placeholder="category"
                            >

                        </div>

                    </div>

                </div>


                <button class="btn btn-primary mt-4">
                    🔗 Generate URL
                </button>

            </form>

        </div>

    </div>


    @if($generatedUrl)

        <div class="card mt-4">

            <div class="card-header fw-bold">
                ✅ Generated URL
            </div>

            <div class="card-body">

                <div
                    id="generatedUrl"
                    class="alert alert-success"
                >
                    {{ $generatedUrl }}
                </div>

                <button
                    class="btn btn-dark"
                    onclick="copyGenerated()"
                >
                    📋 Copy URL
                </button>

            </div>

        </div>

    @endif


    <a
        href="{{ route('url.dashboard') }}"
        class="btn btn-secondary mt-4"
    >
        ← Dashboard
    </a>

</div>


<script>

function copyGenerated() {

    const text =
        document.getElementById('generatedUrl').innerText;

    navigator.clipboard.writeText(text);

    alert('URL copied successfully.');

}

</script>

</body>

</html>
