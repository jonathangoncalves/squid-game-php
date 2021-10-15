<?php

namespace App\Http\Resources;

use App\Models\Game;
use Illuminate\Http\Resources\Json\JsonResource;
/**
 * @mixin Game
 */
class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'player_name' => $this->player_name,
            'player_steps' => $this->player_steps,
            'uuid' => $this->uuid,
            'levels' => $this->levels,
            'status' => $this->status,
        ];
    }
}
