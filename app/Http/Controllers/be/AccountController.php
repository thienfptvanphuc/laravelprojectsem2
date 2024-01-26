<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarAccount;
use Session;

class AccountController extends Controller
{
    //
    public function index(){
        $data['taikhoan'] = CarAccount::get();
        return view("be/pages/accounts/index", $data);
    }

    // Register
    public function add(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "fullname" => "required" ,
                "email" => "required|email | unique:account,email", // exist:account,email : bắt trùng email đã tồn tại không cho, exist: tên bảng, tên cột
                "password" => "required",

            ]);
            $taikhoan = new CarAccount();
            $taikhoan->fullname = $request->fullname;
            $taikhoan->email = $request->email;
            $taikhoan->password = bcrypt($request->password);
            $taikhoan->status = $request->status;
            $taikhoan->role_value = 0;
            $taikhoan->save();
            Session::flash("note", "Add  Successfully");
            return redirect()->route('be.account');
        }
        return view("be/pages/accounts/add");
    }
}
