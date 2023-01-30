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
//            dd($this)
            'project_id'=> $this->id,
            'project_name'=> $this->name,
            'project_slug'=> $this->slug,
            'ProjectLocation'=> new ProjectLocationPesource($this->ProjectLocation),
            'ProjectRisk'=> $this->ProjectRisk,
            'ProjectSafety'=> $this->ProjectSafety,
            'ProjectFunding'=> $this->ProjectFunding,
            'ProjectMedia'=> $this->ProjectMedia
        ];
    }
}
