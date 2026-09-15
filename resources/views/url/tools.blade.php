<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>URL Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f5f7fb; }
        .hero { background: linear-gradient(135deg, #0f766e, #2563eb); color: white; border-radius: 16px; padding: 30px; }
        .card { border: 0; border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,.07); }
        .result { background: #f8f9fa; border: 1px solid #dee2e6; border-radius: 8px; padding: 12px; word-break: break-all; }
        .tool-title { border-bottom: 1px solid #e9ecef; padding-bottom: 10px; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container"><a href="{{ route('url.dashboard') }}" class="navbar-brand fw-bold">URL Inspector</a><a href="{{ route('url.dashboard') }}" class="btn btn-light btn-sm">Dashboard</a></div>
</nav>
<div class="container py-4">
    <div class="hero mb-4"><h1>URL Tools</h1><p class="mb-0">Generate, compare, inspect, and save URLs.</p></div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card h-100"><div class="card-body">
                <h3 class="tool-title">Slug Generator</h3>
                <form method="POST" action="{{ route('url.slug') }}">@csrf<input name="text" class="form-control" value="{{ $text ?? '' }}" placeholder="My Blog Article"><button class="btn btn-primary mt-3">Generate slug</button></form>
                @isset($slug)<div class="mt-3"><small class="text-muted">Before</small><div class="result">{{ $text }}</div><small class="text-muted">After</small><div class="result">{{ $slug }}</div></div>@endisset
            </div></div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100"><div class="card-body">
                <h3 class="tool-title">URL Shortener</h3>
                <form method="POST" action="{{ route('url.shorten') }}">@csrf<input type="url" name="url" class="form-control" placeholder="https://example.com/long-url" required><button class="btn btn-primary mt-3">Create short URL</button></form>
                @isset($shortUrl)<div class="result mt-3"><a href="{{ url('/s/'.$shortUrl->code) }}">{{ url('/s/'.$shortUrl->code) }}</a><button class="btn btn-sm btn-outline-secondary float-end" data-copy="{{ url('/s/'.$shortUrl->code) }}">Copy</button></div>@endisset
            </div></div>
        </div>

        <div class="col-12"><div class="card"><div class="card-body">
            <h3 class="tool-title">Query Parameter Editor</h3>
            <form method="POST" action="{{ route('url.query-tools') }}">@csrf<input name="base_url" class="form-control mb-3" value="{{ $baseUrl ?? '' }}" placeholder="https://example.com/products" required>
            <div id="parameters">@foreach(($parameters ?? [['key'=>'','value'=>'']]) as $index => $parameter)<div class="row g-2 mb-2 parameter-row"><div class="col"><input name="parameters[{{ $index }}][key]" class="form-control" value="{{ $parameter['key'] }}" placeholder="Key"></div><div class="col"><input name="parameters[{{ $index }}][value]" class="form-control" value="{{ $parameter['value'] }}" placeholder="Value"></div><div class="col-auto"><button type="button" class="btn btn-outline-secondary up">↑</button> <button type="button" class="btn btn-outline-secondary down">↓</button> <button type="button" class="btn btn-outline-danger remove">×</button></div></div>@endforeach</div>
            <button type="button" id="add-parameter" class="btn btn-outline-primary">Add parameter</button> <button class="btn btn-primary">Build URL</button></form>
            @if(isset($generatedUrl) && $generatedUrl)<div class="result mt-3">{{ $generatedUrl }} <button class="btn btn-sm btn-outline-secondary float-end" data-copy="{{ $generatedUrl }}">Copy</button></div>@endif
        </div></div></div>

        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">Pagination URL Builder</h3><form method="POST" action="{{ route('url.pagination') }}">@csrf<input type="url" name="url" class="form-control mb-2" placeholder="https://example.com/posts" required><div class="row g-2"><div class="col"><input type="number" name="page" class="form-control" placeholder="Page" min="1" value="1" required></div><div class="col"><input type="number" name="limit" class="form-control" placeholder="Limit" min="1" value="20" required></div></div><button class="btn btn-primary mt-3">Generate URL</button></form></div></div></div>
        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">Signed URL Generator</h3><form method="POST" action="{{ route('url.signed') }}">@csrf<input type="url" name="url" class="form-control mb-2" placeholder="https://example.com" required><input type="number" name="minutes" class="form-control" value="30" min="1" required><button class="btn btn-primary mt-3">Generate signed URL</button></form><form method="POST" action="{{ route('url.signed.verify') }}" class="mt-3">@csrf<input name="signed_url" class="form-control" placeholder="Paste signed URL to verify"><button class="btn btn-outline-primary mt-2">Verify</button></form>@isset($signedUrl)<div class="result mt-3">{{ $signedUrl }}</div>@endisset @isset($verificationResult)<div class="alert {{ $verificationResult ? 'alert-success' : 'alert-danger' }} mt-3 mb-0">{{ $verificationResult ? 'Valid signed URL' : 'Invalid or expired signed URL' }}</div>@endisset</div></div></div>

        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">Redirect Chain Checker</h3><form method="POST" action="{{ route('url.redirect-chain') }}">@csrf<input type="url" name="url" class="form-control" placeholder="https://example.com" required><button class="btn btn-primary mt-3">Check redirects</button></form>@isset($chain)<div class="table-responsive mt-3"><table class="table table-sm"><thead><tr><th>URL</th><th>Status</th><th>Location</th></tr></thead><tbody>@forelse($chain as $hop)<tr><td>{{ $hop['url'] }}</td><td>{{ $hop['status'] }}</td><td>{{ $hop['location'] ?? '-' }}</td></tr>@empty<tr><td colspan="3">No redirect data</td></tr>@endforelse</tbody></table></div>@endisset</div></div></div>
        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">URL Comparison Tool</h3><form method="POST" action="{{ route('url.compare') }}">@csrf<input type="url" name="first_url" class="form-control mb-2" placeholder="First URL" required><input type="url" name="second_url" class="form-control" placeholder="Second URL" required><button class="btn btn-primary mt-3">Compare</button></form>@isset($comparison)<table class="table table-sm mt-3"><thead><tr><th>Component</th><th>First</th><th>Second</th></tr></thead><tbody>@foreach($comparison as $key => $values)<tr class="{{ $values['same'] ? 'table-success' : 'table-warning' }}"><td>{{ ucfirst($key) }}</td><td>{{ $values['first'] ?: '-' }}</td><td>{{ $values['second'] ?: '-' }}</td></tr>@endforeach</tbody></table>@endisset</div></div></div>

        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">Bookmark Manager</h3><input id="bookmark-url" type="url" class="form-control" placeholder="https://example.com"><button id="save-bookmark" class="btn btn-primary mt-3">Save bookmark</button><div id="bookmarks" class="list-group mt-3"></div></div></div></div>
        <div class="col-lg-6"><div class="card h-100"><div class="card-body"><h3 class="tool-title">URL Audit Report</h3><form method="POST" action="{{ route('url.audit') }}">@csrf<input type="url" name="url" class="form-control" placeholder="https://example.com/path?a=1" required><button class="btn btn-primary mt-3">Run audit</button></form>@isset($audit)<div class="table-responsive mt-3"><table class="table table-sm"><tbody>@foreach($audit as $key => $value)<tr><th>{{ ucfirst(str_replace('_', ' ', $key)) }}</th><td>{{ is_string($value) ? $value : json_encode($value) }}</td></tr>@endforeach</tbody></table><div class="d-flex gap-2"><form method="POST" action="{{ route('url.export') }}">@csrf<input type="hidden" name="url" value="{{ $audit['url'] }}"><input type="hidden" name="format" value="json"><button class="btn btn-outline-primary">Export JSON</button></form><form method="POST" action="{{ route('url.export') }}">@csrf<input type="hidden" name="url" value="{{ $audit['url'] }}"><input type="hidden" name="format" value="csv"><button class="btn btn-outline-primary">Export CSV</button></form></div></div>@endisset</div></div></div>
    </div>
</div>
<script>
const list = document.getElementById('parameters');
let parameterIndex = list.querySelectorAll('.parameter-row').length;
document.getElementById('add-parameter').addEventListener('click', () => { list.insertAdjacentHTML('beforeend', `<div class="row g-2 mb-2 parameter-row"><div class="col"><input name="parameters[${parameterIndex}][key]" class="form-control" placeholder="Key"></div><div class="col"><input name="parameters[${parameterIndex}][value]" class="form-control" placeholder="Value"></div><div class="col-auto"><button type="button" class="btn btn-outline-secondary up">↑</button> <button type="button" class="btn btn-outline-secondary down">↓</button> <button type="button" class="btn btn-outline-danger remove">×</button></div></div>`); parameterIndex++; });
list.addEventListener('click', event => { const row = event.target.closest('.parameter-row'); if (!row) return; if (event.target.classList.contains('remove')) row.remove(); if (event.target.classList.contains('up') && row.previousElementSibling) row.parentNode.insertBefore(row, row.previousElementSibling); if (event.target.classList.contains('down') && row.nextElementSibling) row.parentNode.insertBefore(row.nextElementSibling, row); });
const renderBookmarks = () => { const values = JSON.parse(localStorage.getItem('url-bookmarks') || '[]'); document.getElementById('bookmarks').innerHTML = values.map((url, i) => `<div class="list-group-item d-flex justify-content-between"><a href="${url}" target="_blank" rel="noreferrer">${url}</a><button class="btn btn-sm btn-outline-danger" onclick="removeBookmark(${i})">×</button></div>`).join(''); };
document.getElementById('save-bookmark').addEventListener('click', () => { const input = document.getElementById('bookmark-url'); if (!input.value) return; const values = JSON.parse(localStorage.getItem('url-bookmarks') || '[]'); if (!values.includes(input.value)) values.push(input.value); localStorage.setItem('url-bookmarks', JSON.stringify(values)); input.value = ''; renderBookmarks(); });
window.removeBookmark = i => { const values = JSON.parse(localStorage.getItem('url-bookmarks') || '[]'); values.splice(i, 1); localStorage.setItem('url-bookmarks', JSON.stringify(values)); renderBookmarks(); }; renderBookmarks();
document.querySelectorAll('[data-copy]').forEach(button => button.addEventListener('click', () => navigator.clipboard.writeText(button.dataset.copy)));
</script>
</body>
</html>
