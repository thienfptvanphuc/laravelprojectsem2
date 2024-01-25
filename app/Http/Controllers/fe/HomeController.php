<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function detail($name = null, $id = null)
    {

        // đúng dữ liệu mới chạy xử lý
        $data['detail'] = CarProduct::where("id", $id)->where("product_status", 1)->first();
        if ($data['detail']) {
            $data['randomproduct'] = CarProduct::where("type_id", $data['detail']->type_id)->inRandomOrder()->limit(8)->get(); // lấy ngẫu nhiên các phần tử ra cùng id_cat rồi mới random
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

    
}
