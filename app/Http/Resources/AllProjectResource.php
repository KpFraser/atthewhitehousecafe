<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AllProjectResource extends JsonResource
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
            'id'=> $this->id ?? '',
            'name'=> $this->name ?? '',
            'is_approved'=> $this->is_approved ?? '',
            'slug'=> $this->slug ?? '',
            'is_archived'=> $this->is_archived ?? '',
            'is_user'=> !empty($this->projectUser) && !empty($this->projectUser->is_user) ? $this->projectUser->is_user: '',
            'is_key'=> !empty($this->projectUser) && !empty($this->projectUser->is_key) ? $this->projectUser->is_key: '',
            'project_user_id'=> !empty($this->projectUser) && !empty($this->projectUser->id) ? $this->projectUser->id: '',
        ];
    }
}
