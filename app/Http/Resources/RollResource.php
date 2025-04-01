<?php

namespace App\Http\Resources;

use App\Models\Roll;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RollResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Roll $this */
        return [
            'id' => $this->id,
            'number' => $this->number,
            'result' => $this->win ? 'Win' : 'Lose',
            'amount' => $this->amount,
            'created_at' => $this->created_at?->toDateTimeString(),
        ];
    }
}
