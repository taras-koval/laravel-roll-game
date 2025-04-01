<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\Roll;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_game_page_can_be_viewed_with_valid_link()
    {
        $user = User::factory()->create();
        $link = $user->links()->create();

        $response = $this->get(route('game.show', $link->uuid));

        $response->assertOk();
        $response->assertViewIs('page-a');
        $response->assertViewHas('user');
        $response->assertViewHas('link');
    }

    public function test_inactive_link_returns_403()
    {
        $user = User::factory()->create();
        $link = $user->links()->create(['active' => false]);

        $response = $this->get(route('game.show', $link->uuid));
        $response->assertForbidden();

        $response = $this->post(route('game.roll', $link->uuid));
        $response->assertForbidden();

        $response = $this->get(route('game.history', $link->uuid));
        $response->assertForbidden();
    }

    public function test_expired_link_returns_403()
    {
        $user = User::factory()->create();
        $link = Link::factory()->for($user)->withCreatedDaysAgo(8)->create(['active' => true]);

        $response = $this->get(route('game.show', $link->uuid));
        $response->assertForbidden();

        $response = $this->post(route('game.roll', $link->uuid));
        $response->assertForbidden();

        $response = $this->get(route('game.history', $link->uuid));
        $response->assertForbidden();
    }

    public function test_user_can_roll_and_receive_result()
    {
        $user = User::factory()->create();
        $link = $user->links()->create();

        $response = $this->postJson(route('game.roll', $link->uuid));

        $response->assertCreated()
            ->assertJsonStructure([
                'data' => ['number', 'result', 'amount', 'created_at']
            ]);

        $this->assertDatabaseCount('rolls', 1);

        $roll = Roll::first();
        $this->assertEquals($roll->link_id, $link->id);
    }

    public function test_history_returns_last_3_rolls()
    {
        $user = User::factory()->create();
        $link = $user->links()->create();

        Roll::factory()->count(5)->create([
            'link_id' => $link->id,
        ]);

        $response = $this->getJson(route('game.history', $link->uuid));

        $response->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    ['number', 'result', 'amount', 'created_at'],
                ]
            ]);
    }
}
