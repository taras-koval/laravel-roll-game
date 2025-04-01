<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_and_get_unique_link()
    {
        $response = $this->post(route('register'), [
            'username' => 'TestUser',
            'phonenumber' => '1234567890',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('link');

        $this->assertDatabaseHas('users', [
            'username' => 'TestUser',
            'phonenumber' => '1234567890',
        ]);

        $user = User::where('username', 'TestUser')->first();
        $this->assertNotNull($user);

        $this->assertDatabaseHas('links', [
            'user_id' => $user->id,
            'active' => true,
        ]);

        $link = $user->links()->latest()->first();
        $this->assertTrue($link->active);
    }
}
