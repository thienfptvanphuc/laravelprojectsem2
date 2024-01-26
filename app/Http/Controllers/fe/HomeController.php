<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Auth;

use App\Models\CarCategory;
use App\Models\CarProduct;

class HomeController extends Controller
{

    public function home() { // home là trang chủ index
        $data['randomproduct'] = CarProduct::inRandomOrder()->limit(8)->get();
        return view('fe/pages/home');
    }

    // Category
    public function category($id = null){
         // load sản phẩm ra theo id
        $data['loadcarproduct'] = CarProduct::where('type_id', $id)->paginate(3);
        if ($data['loadcarproduct']) {
             // không lỗi hiển thị thằng view lên
             return view("fe/pages/category", $data);
        } else {
             // có lỗi chuyển về trang chủ
            return redirect()->route('fe.home');
        }
    }

    // Detail
    public function detail(Request $request, $name = null, $id = null)
    {
        //Lấy dữ liệu ngày đã được thuê trong database để loại bỏ khỏi lịch khi user chọn ngày
        $data['db_dates'] = DB::table('rental')->select('pickup_date','return_date')
        ->where([['car_id','=',$id],['status','=',1],['processing','!=',0]])->get();
        $data['rented_dates'] = [];
        foreach ($data['db_dates'] as $ddd) {
            $start_date = Carbon::parse($ddd->pickup_date);
            $end_date = Carbon::parse($ddd->return_date);
            while ($start_date <= $end_date) {
                $data['rented_dates'][] = $start_date->toDateString();
                $start_date->addDay();
            }
        }
        // đúng dữ liệu mới chạy xử lý
        $data['detail'] = CarProduct::where("id", $id)->where("product_status", 1)->first();
        if ($data['detail']) {
            $data['randomproduct'] = CarProduct::where("type_id", $data['detail']->type_id)->inRandomOrder()->limit(8)->get(); // lấy ngẫu nhiên các phần tử ra cùng id_cat rồi mới random
            //Xu ly user nhap ngay
            if($request->has('booking')) {
                if(Auth::check()) {
                    // if(Auth::user()->role_value==2) {
                        $validator = Validator::make($request->all(), [
                            'pickup_date'=> ['required','date_format:Y-m-d','after:today',Rule::notIn($data['rented_dates']),],
                            'return_date'=> ['required','date_format:Y-m-d','after_or_equal:pickup_date',Rule::notIn($data['rented_dates']),],
                        ]);
                        if ($validator->fails()) {
                            return redirect()->route('fe.detail',[$name,$id])->withErrors($validator);
                        }
                        $pk_date = Carbon::parse($request->pickup_date);
                        $rt_date = Carbon::parse($request->return_date);
                        $total_days = $pk_date->diffInDays($rt_date) + 1;
                        $madonhang = time().Str::upper(Str::random(4,'alpha'));
                        Session::put('madonhang',$madonhang);
                        Session::put('pickup_date',$request->pickup_date);
                        Session::put('return_date',$request->return_date);
                        Session::put('total_days',$total_days);
                        Session::put('car_id',$id);
                        Session::put('price_per_day',$data['detail']->price);
                        return redirect()->route('fe.rental');
                    // } else {
                        // echo "Can not";}
                    } else {
                        return redirect()->route('fe.login');
                    }
                } 
            return view("fe/pages/detail", $data);
        } else {
            // có lỗi chuyển về trang chủ
            return redirect()->route('fe.home');
        }
        
    }




    public function aboutus() {
        return view('fe/pages/aboutus');
    }
    public function contactus() {
        return view('fe/pages/contactus');
    }

    public function profile_user() {
        return view('fe/pages/profile_user');
    }


    

    
}
