<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnimalKindsResourse extends JsonResource
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
            'kind' => $this->kind,
            'max_size' => $this->max_size,
            'max_age' => $this->max_age,
            'growth_factor' => $this->growth_factor
        ];
    }
}
