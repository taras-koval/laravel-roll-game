<?php

namespace App\Actions;

use App\Models\Link;
use App\Models\Roll;

class RollAction
{
    public function __invoke(Link $link): Roll
    {
        $number = rand(1, 1000);
        $win = $number % 2 === 0;
        $amount = $this->calculateAmount($number, $win);

        return Roll::create([
            'link_id' => $link->id,
            'number' => $number,
            'win' => $win,
            'amount' => $amount,
        ]);
    }

    private function calculateAmount(int $number, bool $win): int
    {
        if (!$win) {
            return 0;
        }

        return match (true) {
            $number > 900 => (int) round($number * 0.7),
            $number > 600 => (int) round($number * 0.5),
            $number > 300 => (int) round($number * 0.3),
            default => (int) round($number * 0.1),
        };
    }
}
