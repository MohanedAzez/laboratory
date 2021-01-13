<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsRes;
use App\Http\Resources\StaffRes;
use App\Models\News;
use App\Models\Staff;
use Illuminate\Http\Request;

class NewsAPI extends BaseController
{
    public function getNewsAPI() {
        $news = News::orderBy('id', 'desc')->get();
        return $this->sendResponse(NewsRes::collection($news),
            'All News sent');
    }
}
