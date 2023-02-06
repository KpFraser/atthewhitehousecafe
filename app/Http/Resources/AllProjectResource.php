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
//dd($this);
        return [
            'id'=> $this->id ?? '',
            'name'=> $this->name ?? '',
            'is_approved'=> $this->is_approved ?? '',
            'slug'=> $this->slug ?? '',
//            'created_by'=> $this->created_by ?? '',
            'is_archived'=> $this->is_archived ?? '',
            'is_user_by'=> !empty($this->projectUserInfo) && !empty($this->projectUserInfo->user_id) ? $this->projectUserInfo->user_id: '',
            'is_user'=> !empty($this->projectUserInfo) && !empty($this->projectUserInfo->is_user) ? $this->projectUserInfo->is_user: '',
            'is_key'=> !empty($this->projectUserInfo) && !empty($this->projectUserInfo->is_key) ? $this->projectUserInfo->is_key: '',
            'project_user_id'=> !empty($this->projectUserInfo) && !empty($this->projectUserInfo->id) ? $this->projectUserInfo->id: '',
        ];
    }
}
