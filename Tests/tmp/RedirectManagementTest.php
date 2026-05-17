<?php

namespace Modules\Redirect\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Modules\Redirect\Models\Redirect;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class RedirectManagementTest extends TestCase
{

    use DatabaseMigrations;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        // Seed base data
        Artisan::call("db:seed", ['--class' => 'RoleSeeder']);

        // Create and assign admin role to user
        $this->admin = User::factory()->create();
        $this->admin->assignRole('admin'); // Assumes Spatie roles or similar
    }


    public function test_only_auth()
    {
   
        // Access without logging in
        $response = $this->getJson(route('api.redirects.redirect.index'));
        $response->assertStatus(401);
    }


    public function test_only_access_for_admins()
    {
        
        $user = User::factory()->create();

        // Access without logging in
        $response = $this->actingAs($user)->getJson(route('api.redirects.redirect.index'));
        $response->assertStatus(403);
    }


    public function test_it_can_fetch_merged_redirects()
    {
        Redirect::create([
            'name' => 'test-redirect',
            'url'  => 'https://example.com'
        ]);

        $response = $this->actingAs($this->admin)->getJson(route('api.redirects.redirect.index'));
        $response->assertStatus(200);
    }

    public function test_it_can_create_a_new_redirect()
    {
        $data = [
            'name' => 'new-redirect',
            'url'  => 'https://new-redirect.com'
        ];

        $response = $this->actingAs($this->admin)->postJson(route('api.redirects.redirect.store'), $data);
        $response->assertStatus(201);

    }


    public function test_it_can_update_redirects()
    {
        
        $redirect = Redirect::create([
            'name' => 'update-redirect',
            'url'  => 'https://old-url.com'
        ]);

        $data = [
            'redirects' => [
                'update-redirect' => 'https://updated-url.com'
            ]
        ];

        $response = $this->actingAs($this->admin)->patchJson(route('api.redirects.redirect.update', ['redirect' => $redirect->id]), $data);
        $response->assertStatus(200);
     
    }


    public function test_it_can_delete_a_redirect()
    {
        $redirect = Redirect::create([
            'name' => 'delete-redirect',
            'url'  => 'https://delete-redirect.com'
        ]);

     
        $response = $this->actingAs($this->admin)->deleteJson(route('api.redirects.redirect.destroy', ['redirect' => $redirect->id]));
        $response->assertNoContent();
 
    }

}
