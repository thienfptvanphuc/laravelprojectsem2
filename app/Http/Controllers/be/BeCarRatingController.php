<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarRating;
use Session;

class BeCarRatingController extends Controller
{
    // Function Index
    public function rating()
    {
        $data['list_rate'] = CarRating::get();  // lấy tất cả record
        return view("be/pages/cars/rating/index", $data);
    }

}
