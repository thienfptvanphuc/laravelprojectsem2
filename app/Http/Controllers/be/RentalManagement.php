<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
//Model
use App\Models\Rental;


class RentalManagement extends Controller
{
    public function index() {
        $data['rentals'] = DB::table('rental')
        ->join('cars', 'rental.car_id', '=', 'cars.id')
        ->join('account', 'rental.account_id', '=', 'account.id')
        ->select('rental.*', 'cars.name','account.email')->get();
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        return view('be/pages/rental/index',$data);
    }
    public function addnew(Request $request) {
        $data['car_type'] = DB::table('car_type')->select('car_type.id','car_type.name')->get();
        $data['cars'] = DB::table('cars')->select('cars.id','cars.name','cars.type_id')->get();
        if($request->isMethod('post')) {
            $rental = new Rental();
            $rental->car_id = $request->car_id;
            $rental->code = time().Str::upper(Str::random(4,'alpha'));
            $rental->account_id = $request->account_id;
            $rental->pickup_date = $request->pickup_date;
            $rental->return_date = $request->return_date;
            $rental->note = $request->note;
            $rental->processing = $request->processing;
            $rental->status = 1;
            $rental->save();
            return redirect()->route('be.rental');
        } else {
        return view('be/pages/rental/addnew',$data);
        }
    }
    public function detail(Request $request, $id=null) {
        if($request->isMethod('post')) {
            // $this->validate($request,[
            //     "name"=>"required",
            //     "keyword"=>"required",
            //     "desc"=>"required",
            //     "price"=>"required|numeric",
            //     "thumb"=>"mimes:jpeg,png,gif,jpg,ico|max:4096",
            //     "content"=>"required"
            // ]);
            $rental =Rental::find($id);
            $rental->car_id = $request->car_id;
            $rental->account_id = $request->account_id;
            $rental->pickup_date = $request->pickup_date;
            $rental->return_date = $request->return_date;
            $rental->note = $request->note;
            $rental->processing = $request->processing;
            $rental->status = $request->status;
            $rental->save();
            return redirect()->back();
        } else {
            $data['rental'] = Rental::find($id);
            $data['car_type'] = DB::table('car_type')->select('car_type.id','car_type.name')->get();
            $data['cars'] = DB::table('cars')->select('cars.id','cars.name','cars.type_id')->get();
            $data['account'] = DB::table('account')->select('id','email')
            ->where('id','=',$data['rental']->account_id)->first();
            return view('be/pages/rental/rental-detail',$data);
        }

    }
    public function del($id) {
        // $load = Product::find($id);
        try {
            //code...
            $load = Rental::find($id);
            Rental::destroy($id);
            return redirect()->route('be.rental');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
