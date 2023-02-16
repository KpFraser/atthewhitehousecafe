<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class CafeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($this->UserComments);
        if(empty($this->date) && empty($this->start_time) && empty($this->end_time)){
            $time_date = Carbon::now()->toDateTimeString();
            $date = Carbon::parse($time_date)->format('Y-m-d');
            $start_time = Carbon::parse($time_date)->format('h:m:s');
            $end_time = Carbon::parse($time_date)->addHour()->format('h:m:s');
        } else {
            $date = $this->date;
            $start_time = $this->start_time;
            $end_time = $this->end_time;
        }
        return [
            'id' =>$this->id ?? '',
            'comment' =>$this->comment ?? '',
            'cycle_track_image' =>$this->CycleTrackImage ?? [],
            'date' =>$date ?? '',
            'start_time' =>$start_time ?? '',
            'end_time' =>$end_time ?? '',
            'user_attendance' =>$this->UserAttendance ?? [],
            'user_comments' => $this->UserComments ?? []
        ];
    }
}
