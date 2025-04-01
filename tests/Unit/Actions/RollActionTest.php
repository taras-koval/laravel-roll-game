<?php

namespace Tests\Unit\Actions;

use App\Actions\RollAction;
use App\Models\Link;
use App\Models\Roll;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReflectionClass;
use Tests\TestCase;

class RollActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_roll_with_valid_data()
    {
        $link = Link::factory()->create();

        $action = new RollAction();
        $roll = $action($link);

        $this->assertInstanceOf(Roll::class, $roll);
        $this->assertEquals($roll->link_id, $link->id);
        $this->assertGreaterThanOrEqual(1, $roll->number);
        $this->assertLessThanOrEqual(1000, $roll->number);
        $this->assertIsBool($roll->win);
        $this->assertIsInt($roll->amount);
    }

    public function test_amount_calculation_uses_correct_formula()
    {
        $rollActionReflection = new ReflectionClass(RollAction::class);
        $method = $rollActionReflection->getMethod('calculateAmount');

        $method->setAccessible(true);

        $action = new RollAction();

        $this->assertEquals(700, $method->invoke($action, 1000, true));
        $this->assertEquals(0, $method->invoke($action, 999, false));
    }
}
