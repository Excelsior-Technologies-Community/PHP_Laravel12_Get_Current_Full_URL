<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class UrlToolsTest extends TestCase
{
    use RefreshDatabase;

    public function test_slug_generator_shows_before_and_after(): void
    {
        $this->post('/url-tools/slug', ['text' => 'Hello, Laravel World!'])
            ->assertOk()
            ->assertSee('Hello, Laravel World!')
            ->assertSee('hello-laravel-world');
    }

    public function test_short_url_is_stored_and_redirects(): void
    {
        $response = $this->post('/url-tools/shorten', ['url' => 'https://example.com/articles/1']);
        $response->assertOk();

        $shortUrl = ShortUrl::firstOrFail();
        $this->get('/s/' . $shortUrl->code)
            ->assertRedirect('https://example.com/articles/1');
    }

    public function test_query_editor_and_pagination_builder_generate_urls(): void
    {
        $this->post('/url-tools/query', [
            'base_url' => 'https://example.com/products',
            'parameters' => [
                ['key' => 'status', 'value' => 'published'],
                ['key' => 'page', 'value' => '2'],
            ],
        ])->assertOk()->assertSee('https://example.com/products?status=published&amp;page=2', false);

        $this->post('/url-tools/pagination', [
            'url' => 'https://example.com/products?sort=latest',
            'page' => 3,
            'limit' => 25,
        ])->assertOk()->assertSee('https://example.com/products?sort=latest&amp;page=3&amp;limit=25', false);
    }

    public function test_signed_url_can_be_verified_and_rejects_tampering(): void
    {
        $signedResponse = $this->post('/url-tools/signed', [
            'url' => 'https://example.com/private',
            'minutes' => 10,
        ])->assertOk();

        preg_match('/https?:\/\/[^<\s]+signature=[^<\s]+/', $signedResponse->getContent(), $matches);
        $signedUrl = html_entity_decode($matches[0] ?? '');
        $this->assertNotEmpty($signedUrl);

        $this->post('/url-tools/signed/verify', ['signed_url' => $signedUrl])
            ->assertOk()
            ->assertSee('Valid signed URL');

        $this->get($signedUrl . '&tampered=1')->assertForbidden();
    }

    public function test_redirect_chain_comparison_audit_and_exports(): void
    {
        Http::fake([
            'https://example.com/start' => Http::response('', 301, ['Location' => 'https://example.com/final']),
            'https://example.com/final' => Http::response('', 200),
        ]);

        $this->post('/url-tools/redirect-chain', ['url' => 'https://example.com/start'])
            ->assertOk()
            ->assertSee('301')
            ->assertSee('200');

        $this->post('/url-tools/compare', [
            'first_url' => 'https://example.com/a?x=1',
            'second_url' => 'https://example.com/b?x=2',
        ])->assertOk()->assertSee('table-warning');

        $this->post('/url-tools/audit', ['url' => 'https://example.com/a?x=1'])
            ->assertOk()
            ->assertSee('Query count')
            ->assertSee('1');

        $this->post('/url-tools/export', ['url' => 'https://example.com/a?x=1', 'format' => 'json'])
            ->assertOk()
            ->assertHeader('Content-Disposition', 'attachment; filename="url-audit.json"')
            ->assertJsonPath('query_count', 1);

        $this->post('/url-tools/export', ['url' => 'https://example.com/a?x=1', 'format' => 'csv'])
            ->assertOk()
            ->assertHeader('Content-Type', 'text/csv; charset=utf-8')
            ->assertSee('query_count,1', false);
    }
}