<?php

namespace Modules\Redirect\Tests\Feature;

use Tests\TestCase;
use Modules\Redirect\Models\Redirect;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RedirectForwardingTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        // Slå auth / api middleware fra for feature-tests
        $this->withoutMiddleware();
    }

    /**
     * Test that a valid string name returns the correct redirect URL.
     */
    public function test_redirect_by_name()
    {
        Redirect::create([
            'name' => 'test-redirect',
            'url'  => 'https://example.com',
        ]);

        $response = $this->get(
            route('redirect.forward', [
                'idOrName' => 'test-redirect',
            ])
        );

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com');
    }

    /**
     * Test that a valid ID returns the correct redirect URL.
     */
    public function test_redirect_by_id()
    {
        $redirect = Redirect::create([
            'name' => 'test-redirect-id',
            'url'  => 'https://example.com',
        ]);

        $response = $this->get(
            route('redirect.forward', [
                'idOrName' => $redirect->id,
            ])
        );

        $response->assertStatus(302);
        $response->assertRedirect('https://example.com');
    }

    /**
     * Test that an invalid name or ID returns a 404 error.
     */
    public function test_redirect_not_found()
    {
        $response = $this->get(
            route('redirect.forward', [
                'idOrName' => 'non-existent-redirect',
            ])
        );

        $response->assertStatus(404);
    }
}
