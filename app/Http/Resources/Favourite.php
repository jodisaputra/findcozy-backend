<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Favourite extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user' => new User($this->user),
            'boardinghouse' => new BoardingHouse($this->boardinghouse)
        ];
    }
}
