<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rental;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    public function rental(Request $request) {
        if($request->isMethod('post')) {
            $rental = new Rental();
            $rental->car_id = "2";
            $rental->account_id = "5";
            $rental->pickup_date =Session::get('pickup_date');
            $rental->return_date = Session::get('return_date');
            $rental->note = $request->note;
            $rental->processing=3;
            $rental->status=1;
            $rental->save();
            Session::flush();
        } else {
            return view('fe/pages/rental');
        }
    }
    
    public function list() {
        return view('fe/pages/list-car');
    }
    public function cardetail(Request $request, $id) {
        $data['car']=DB::table('cars')->find($id);
        $data['dsd'] = DB::table('rental')->select('pickup_date','return_date')
        ->where([['car_id','=',$id],['status','=',1],['processing','!=',0]])->get();
        if($request->isMethod('post')) {
            // Your input data

            // $this->validate($request,[
            //     'pickup_date'=> 'required|date|after:now',
            //     'return_date'=> 'required|date|after_or_equal:pickup_date'
            // ]);
            Session::put('pickup_date',$request->pickup_date );
            Session::put('return_date',$request->return_date);
            return redirect()->route('fe.rental');
        } else {
            return view('fe/pages/car-detail',$data);
        }
    }
    public function payment() {
        echo "momo";
    }
}



        //  echo "<pre>";
        // print_r($data);
        // echo "</pre>";s
