<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function rental(Request $request) {
        if($request->isMethod('post')) {
        } else {
            return view('fe/pages/rental');
        }
    }
    public function payment() {
        echo "momo";
    }
}
