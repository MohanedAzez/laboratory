<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PatFile extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'patient_id'=>$this->patient_id,
            'file'=>$this->file,
            'state'=>$this->state,
            'created_at'=>$this->created_at,

        ];
    }
}
