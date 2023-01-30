<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectLocationPesource extends JsonResource
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
            'id'=> $this->id,
            'user_id'=> $this->user_id,
            'project_id'=> $this->project_id,
            'address_1'=> $this->address_1,
            'address_2'=> $this->address_2,
            'city'=> $this->city,
            'postcode'=> $this->postcode,
            'country'=> $this->country,
            'repeat_time'=> $this->repeat_time,
            'repeat_every'=> $this->repeat_every,
            'repeat_on' => json_decode($this->repeat_on),
            'never'=> $this->never,
            'on'=> $this->on,
            'after'=> $this->after
        ];
    }
}
