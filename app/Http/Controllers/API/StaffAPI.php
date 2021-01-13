<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderRes;
use App\Http\Resources\StaffRes;
use App\Models\Slider;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffAPI extends BaseController
{
    public function getStaffAPI() {

        $staff = Staff::orderby('id', 'desc')->get();
        return $this->sendResponse(StaffRes::collection($staff),
            'All Staff sent');
    }
}
