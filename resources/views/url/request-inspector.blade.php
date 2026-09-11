<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Request Headers & Security Inspector</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>

        body {
            background: #f5f7fb;
        }

        .navbar-brand {
            font-weight: 700;
        }

        .hero {
            background: linear-gradient(135deg, #dc3545, #6610f2);
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

        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            height: 100%;
        }

        .stat-title {
            color: #6c757d;
            font-size: 14px;
        }

        .stat-value {
            font-size: 22px;
            font-weight: 700;
            margin-top: 5px;
            word-break: break-word;
        }

        .value-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 12px;
            word-break: break-all;
        }

        .security-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.07);
            height: 100%;
        }

        .security-icon {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .security-title {
            font-weight: 700;
            font-size: 18px;
        }

        .security-status {
            font-size: 14px;
            margin-top: 8px;
        }

        code {
            word-break: break-all;
        }

        .table {
            margin-bottom: 0;
        }

        .header-key {
            font-weight: 700;
            color: #495057;
        }

        .header-value {
            word-break: break-all;
        }

        footer {
            text-align: center;
            color: #6c757d;
            padding: 25px 0;
        }

    </style>

</head>


<body>


<!-- Navbar -->

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            href="{{ route('url.dashboard') }}"
            class="navbar-brand"
        >
            🔎 Laravel URL Inspector
        </a>


        <div>

            <a
                href="{{ route('url.dashboard') }}"
                class="btn btn-light btn-sm me-1"
            >
                Dashboard
            </a>


            <a
                href="{{ route('query.inspector') }}"
                class="btn btn-warning btn-sm me-1"
            >
                Query Inspector
            </a>


            <a
                href="{{ route('route.info') }}"
                class="btn btn-info btn-sm me-1"
            >
                Route Info
            </a>


            <a
                href="{{ route('request.inspector') }}"
                class="btn btn-danger btn-sm"
            >
                Request Inspector
            </a>

        </div>

    </div>

</nav>


<div class="container py-4">


    <!-- Hero -->

    <div class="hero">

        <h1>

            🔐 Request Headers & Security Inspector

        </h1>

        <p class="mb-0">

            Inspect Laravel request headers, client information
            and basic security details.

        </p>

    </div>


    <!-- Statistics -->

    <div class="row g-4 mb-4">


        <!-- Header Count -->

        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">

                        Request Headers

                    </div>

                    <div class="stat-value text-primary">

                        {{ $headerCount }}

                    </div>

                </div>

            </div>

        </div>


        <!-- HTTP Method -->

        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">

                        HTTP Method

                    </div>

                    <div class="stat-value">

                        <span class="badge bg-success">

                            {{ $method }}

                        </span>

                    </div>

                </div>

            </div>

        </div>


        <!-- Protocol -->

        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">

                        Protocol

                    </div>

                    <div class="stat-value text-info">

                        {{ strtoupper($protocol) }}

                    </div>

                </div>

            </div>

        </div>


        <!-- IP Address -->

        <div class="col-md-3">

            <div class="card stat-card">

                <div class="card-body">

                    <div class="stat-title">

                        Client IP

                    </div>

                    <div class="stat-value">

                        {{ $ipAddress ?? 'Unknown' }}

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- Security Status -->

    <div class="card info-card">

        <div class="card-header">

            🛡️ Security & Request Status

        </div>


        <div class="card-body">

            <div class="row g-4">


                <!-- HTTPS -->

                <div class="col-md-4">

                    <div class="card security-card border">

                        <div class="card-body text-center">

                            <div class="security-icon">

                                🔒

                            </div>


                            <div class="security-title">

                                HTTPS Connection

                            </div>


                            <div class="security-status">

                                @if($isHttps)

                                    <span class="badge bg-success">

                                        Secure HTTPS

                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">

                                        HTTP Connection

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                <!-- AJAX -->

                <div class="col-md-4">

                    <div class="card security-card border">

                        <div class="card-body text-center">

                            <div class="security-icon">

                                ⚡

                            </div>


                            <div class="security-title">

                                AJAX Request

                            </div>


                            <div class="security-status">

                                @if($isAjax)

                                    <span class="badge bg-success">

                                        AJAX Request

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Normal Request

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


                <!-- JSON -->

                <div class="col-md-4">

                    <div class="card security-card border">

                        <div class="card-body text-center">

                            <div class="security-icon">

                                📦

                            </div>


                            <div class="security-title">

                                JSON Expected

                            </div>


                            <div class="security-status">

                                @if($isJson)

                                    <span class="badge bg-success">

                                        JSON Response Expected

                                    </span>

                                @else

                                    <span class="badge bg-secondary">

                                        Standard HTML Request

                                    </span>

                                @endif

                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>


    <!-- Client Information -->

    <div class="card info-card">

        <div class="card-header">

            🌐 Client Information

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <tbody>


                        <tr>

                            <th width="30%">

                                IP Address

                            </th>

                            <td>

                                {{ $ipAddress ?? 'Unknown' }}

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

                                HTTP Method

                            </th>

                            <td>

                                <span class="badge bg-success">

                                    {{ $method }}

                                </span>

                            </td>

                        </tr>


                        <tr>

                            <th>

                                Protocol

                            </th>

                            <td>

                                <span class="badge bg-info text-dark">

                                    {{ strtoupper($protocol) }}

                                </span>

                            </td>

                        </tr>


                        <tr>

                            <th>

                                User Agent

                            </th>

                            <td>

                                <div class="value-box">

                                    {{ $userAgent ?? 'Unknown' }}

                                </div>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Important Headers -->

    <div class="card info-card">

        <div class="card-header">

            📡 Important Request Headers

        </div>


        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th width="30%">

                                Header

                            </th>

                            <th>

                                Value

                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <tr>

                            <td class="header-key">

                                Accept

                            </td>

                            <td class="header-value">

                                {{ $acceptHeader ?? 'Not provided' }}

                            </td>

                        </tr>


                        <tr>

                            <td class="header-key">

                                Content-Type

                            </td>

                            <td class="header-value">

                                {{ $contentType ?? 'Not provided' }}

                            </td>

                        </tr>


                        <tr>

                            <td class="header-key">

                                Referer

                            </td>

                            <td class="header-value">

                                {{ $referer ?? 'Not provided' }}

                            </td>

                        </tr>


                        <tr>

                            <td class="header-key">

                                X-Requested-With

                            </td>

                            <td class="header-value">

                                {{ $xRequestedWith ?? 'Not provided' }}

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- All Headers -->

    <div class="card info-card">

        <div class="card-header">

            📋 All Request Headers

        </div>


        <div class="card-body p-0">


            @if($headerCount > 0)

                <div class="alert alert-success m-3">

                    <strong>

                        {{ $headerCount }}

                    </strong>

                    request header group(s) detected successfully.

                </div>


                <div class="table-responsive">

                    <table class="table table-bordered table-hover">

                        <thead class="table-dark">

                            <tr>

                                <th width="35%">

                                    Header Name

                                </th>

                                <th>

                                    Header Value

                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @foreach($headers as $key => $values)

                                <tr>

                                    <td>

                                        <strong>

                                            {{ ucwords(str_replace('-', ' ', $key)) }}

                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $key }}

                                        </small>

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

                <div class="alert alert-warning m-3">

                    No request headers were found.

                </div>

            @endif

        </div>

    </div>


    <!-- Laravel Request Cheat Sheet -->

    <div class="card info-card">

        <div class="card-header">

            📚 Laravel Request Cheat Sheet

        </div>


        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped">

                    <thead>

                        <tr>

                            <th>

                                Information

                            </th>

                            <th>

                                Laravel Code

                            </th>

                        </tr>

                    </thead>


                    <tbody>


                        <tr>

                            <td>

                                Request Headers

                            </td>

                            <td>

                                <code>

                                    $request->headers->all()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                Specific Header

                            </td>

                            <td>

                                <code>

                                    $request->header('Accept')

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                IP Address

                            </td>

                            <td>

                                <code>

                                    $request->ip()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                HTTP Method

                            </td>

                            <td>

                                <code>

                                    $request->method()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                HTTPS Check

                            </td>

                            <td>

                                <code>

                                    $request->isSecure()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                AJAX Check

                            </td>

                            <td>

                                <code>

                                    $request->ajax()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                JSON Request Check

                            </td>

                            <td>

                                <code>

                                    $request->expectsJson()

                                </code>

                            </td>

                        </tr>


                        <tr>

                            <td>

                                Host

                            </td>

                            <td>

                                <code>

                                    $request->getHost()

                                </code>

                            </td>

                        </tr>


                    </tbody>

                </table>

            </div>

        </div>

    </div>


    <!-- Navigation -->

    <div class="card info-card">

        <div class="card-header">

            🚀 Explore URL Inspector

        </div>


        <div class="card-body">

            <a
                href="{{ route('url.dashboard') }}"
                class="btn btn-primary me-2 mb-2"
            >
                🔎 URL Dashboard
            </a>


            <a
                href="{{ route('query.inspector') }}"
                class="btn btn-warning me-2 mb-2"
            >
                🧩 Query Inspector
            </a>


            <a
                href="{{ route('route.info') }}"
                class="btn btn-info me-2 mb-2"
            >
                🛣️ Route Information
            </a>

        </div>

    </div>


</div>


<footer>

    Laravel 12 URL & Request Inspector

</footer>


</body>

</html>