<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
            'identity'=> $this->id,
            'name'=> $this->name,
            'location'=> $this->location,
            'frequency'=> $this->frequency,
            'requirements'=> $this->requirements,
            'leadership'=> $this->leadership,
            'approve'=> $this->is_approved
        ];
    }
}
