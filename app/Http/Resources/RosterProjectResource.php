<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RosterProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($request);
        return[
            'identity'=>!empty($this->project_users) && !empty($this->project_users->id) ? $this->project_users->id: '',
            'name'=> !empty($this->project_users) && !empty($this->project_users->name) ? $this->project_users->name: ''
        ];
    }
}
