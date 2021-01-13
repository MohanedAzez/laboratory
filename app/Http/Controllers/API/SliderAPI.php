<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryRecource;
use App\Http\Resources\SliderRes;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderAPI extends BaseController
{

    public function getSliderAPI() {

        $category = Slider::all();
        return $this->sendResponse(SliderRes::collection($category),
            'All Slider sent');
    }
}
