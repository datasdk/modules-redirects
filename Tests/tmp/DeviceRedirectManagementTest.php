<?php

namespace Modules\Redirect\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Modules\Redirect\Models\DeviceRedirect;
use Tests\TestCase;
use App\Models\User;

class DeviceRedirectManagementTest extends TestCase
{
    use DatabaseMigrations;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed base data (roller osv.)
        Artisan::call('db:seed', ['--class' => 'RoleSeeder']);

        // Opret en admin-bruger og giv web-guard rolle
        $this->admin = User::factory()->create();

        // Hvis rollen allerede eksisterer for web-guard
        $this->admin->assignRole('admin'); 

        // Alternativt, hvis du vil specificere guard eksplicit:
        // $this->admin->assignRole(['name' => 'admin', 'guard_name' => 'web']);
    }

    public function test_guest_cannot_access_device_redirects()
    {
        $response = $this->getJson(route('api.redirects.device.index'));
        $response->assertStatus(401);
    }

    public function test_non_admin_cannot_access_device_redirects()
    {
        $user = User::factory()->create();

        // Brug web guard eksplicit
        $response = $this->actingAs($user, 'web')->getJson(route('api.redirects.device.index'));
        $response->assertStatus(403);
    }

    public function test_admin_can_create_device_redirect()
    {
        $data = [
            'name'     => 'redirect-1',
            'platform' => 'ios',
            'url'      => 'https://ios.example.com',
        ];

        $response = $this->actingAs($this->admin, 'web')->postJson(route('api.redirects.device.store'), $data);
        $response->assertStatus(201)->assertJsonFragment(['name' => 'redirect-1']);
    }

    public function test_admin_can_update_device_redirect()
    {
        $deviceRedirect = DeviceRedirect::create([
            'name'     => 'redirect-2',
            'platform' => 'android',
            'url'      => 'https://old-url.com',
        ]);

        $updateData = [
            'name'     => 'redirect-2-updated',
            'platform' => 'android',
            'url'      => 'https://new-url.com',
        ];

        $response = $this->actingAs($this->admin, 'web')
            ->putJson(route('api.redirects.device.update', $deviceRedirect->id), $updateData);

        $response->assertStatus(200)->assertJsonFragment(['url' => 'https://new-url.com']);
    }

    public function test_admin_can_delete_device_redirect()
    {
        $deviceRedirect = DeviceRedirect::create([
            'name'     => 'redirect-delete',
            'platform' => 'web',
            'url'      => 'https://delete-me.com',
        ]);

        $response = $this->actingAs($this->admin, 'web')
            ->deleteJson(route('api.redirects.device.destroy', $deviceRedirect->id));

        $response->assertNoContent();

        $this->assertDatabaseMissing('device_redirects', ['id' => $deviceRedirect->id]);
    }
}
