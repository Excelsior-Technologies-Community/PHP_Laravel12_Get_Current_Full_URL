<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Header Search</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .hero {
            background: linear-gradient(135deg, #ffc107, #fd7e14);
            color: #212529;
            border-radius: 18px;
            padding: 35px;
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,.07);
        }

        .header-value {
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

        <h1>🔎 Request Header Search</h1>

        <p class="mb-0">
            Search request headers by name or value.
        </p>

    </div>


    <div class="card mb-4">

        <div class="card-body">

            <form method="GET">

                <div class="input-group">

                    <input
                        type="text"
                        name="search"
                        value="{{ $search }}"
                        class="form-control"
                        placeholder="Accept, User-Agent, Content-Type..."
                    >

                    <button class="btn btn-primary">
                        Search
                    </button>

                </div>

            </form>

        </div>

    </div>


    <div class="card">

        <div class="card-header">

            📋 Headers Found:
            <strong>{{ $headerCount }}</strong>

        </div>

        <div class="card-body p-0">

            @if($headerCount)

                <div class="table-responsive">

                    <table class="table table-bordered table-hover mb-0">

                        <thead class="table-dark">

                            <tr>

                                <th width="35%">
                                    Header
                                </th>

                                <th>
                                    Value
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($headers as $key => $values)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $key }}
                                        </strong>
                                    </td>

                                    <td class="header-value">
                                        {{ implode(', ', $values) }}
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="p-3">

                    <div class="alert alert-warning mb-0">
                        No matching headers found.
                    </div>

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

