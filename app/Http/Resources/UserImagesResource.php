<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'PUI_identity'=> $this->id,
            'PU_identity'=> $this->project_user_id,
            'P_identity'=> $this->project_id,
            'image'=> $this->image_name,
            'system_name'=> $this->system_name,
        ];
    }
}
