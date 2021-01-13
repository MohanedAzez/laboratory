<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NewsRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return[
            'id'=>$this->id,
            'picture'=>$this->picture,
            'tittle'=>$this->tittle,
            'desc'=>$this->desc,
            'created_at'=>$this->created_at,
        ];
    }
}
