<?php

namespace Modules\Redirect\Tests\Feature;

use Tests\TestCase;
use Modules\Redirect\Models\DeviceRedirect;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeviceRedirectForwardingTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();

        // Slå auth-middleware fra for disse feature-tests
        $this->withoutMiddleware();
    }

    /**
     * Test that a valid device redirect by name and platform returns the correct redirect URL.
     */
    public function test_device_redirect_by_name_and_platform()
    {
        DeviceRedirect::create([
            'name' => 'test-redirect',
            'platform' => 'ios',
            'url' => 'https://example-ios.com',
        ]);

        $response = $this->get(
            route('redirect.device.forward', [
                'idOrName' => 'test-redirect',
                'platform' => 'ios',
            ])
        );

        $response->assertStatus(302);
        $response->assertRedirect('https://example-ios.com');
    }

    /**
     * Test that a non-existent device redirect returns 404.
     */
    public function test_device_redirect_not_found()
    {
        $response = $this->get(
            route('redirect.device.forward', [
                'idOrName' => 'non-existent-redirect',
                'platform' => 'ios',
            ])
        );

        $response->assertStatus(404);
    }

    /**
     * Test that a valid device redirect by Android platform returns the correct redirect URL.
     */
    public function test_device_redirect_by_android_platform()
    {
        DeviceRedirect::create([
            'name' => 'test-android-redirect',
            'platform' => 'android',
            'url' => 'https://example-android.com',
        ]);

        $response = $this->get(
            route('redirect.device.forward', [
                'idOrName' => 'test-android-redirect',
                'platform' => 'android',
            ])
        );

        $response->assertStatus(302);
        $response->assertRedirect('https://example-android.com');
    }

    /**
     * Test that a request without a platform falls back to the user agent / default redirect.
     */
    public function test_device_redirect_without_platform_falls_back_to_user_agent()
    {
        DeviceRedirect::create([
            'name' => 'test-fallback-redirect',
            'platform' => 'default',
            'url' => 'https://example-ios-fallback.com',
        ]);

        $response = $this->get(
            route('redirect.device.forward', [
                'idOrName' => 'test-fallback-redirect',
            ])
        );

        $response->assertStatus(302);
        $response->assertRedirect('https://example-ios-fallback.com');
    }
}
