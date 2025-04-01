<?php

namespace Tests\Unit\Actions;

use App\Actions\CreateLinkAction;
use App\Models\Link;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateLinkActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_new_active_link_and_deactivates_previous()
    {
        $user = User::factory()->create();

        $oldLink = $user->links()->create([
            'uuid' => 'test-uuid-1',
            'active' => true,
        ]);

        $action = new CreateLinkAction();
        $newLink = $action($user);

        $this->assertInstanceOf(Link::class, $newLink);
        $this->assertTrue($newLink->active);
        $this->assertEquals($user->id, $newLink->user_id);

        $this->assertFalse($oldLink->fresh()->active);
    }
}
