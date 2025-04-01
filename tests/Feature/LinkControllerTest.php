<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_regenerate_link_and_deactivate_old_one()
    {
        $user = User::factory()->create();

        $oldLink = $user->links()->create([
            'uuid' => 'test-uuid',
            'active' => true,
        ]);

        $response = $this->post(route('link.regenerate', $oldLink->uuid));

        $response->assertRedirect(route('index'));
        $response->assertSessionHas('link');

        $oldLink->refresh();
        $this->assertFalse($oldLink->active);

        $this->assertDatabaseCount('links', 2);

        $newLink = Link::whereNot('id', $oldLink->id)->first();
        $this->assertTrue($newLink->active);
        $this->assertEquals($user->id, $newLink->user_id);
    }

    public function test_it_can_deactivate_link()
    {
        $user = User::factory()->create();

        $link = $user->links()->create([
            'active' => true,
        ]);

        $response = $this->post(route('link.deactivate', $link->uuid));

        $response->assertRedirect(route('index'));
        $response->assertSessionHas('message', 'Link has been deactivated.');

        $this->assertFalse($link->fresh()->active);
    }
}
