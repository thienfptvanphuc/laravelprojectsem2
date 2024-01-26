<?php

namespace App\Http\Controllers\fe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarAccount;
use Auth;
use Bcrypt;


class CarAccountController extends Controller
{
    //
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            // Thực hiện xác thực đăng nhập
            
            $account = $request->only('email', 'password');

            if (Auth::attempt($account)) {
                // Đăng nhập thành công, chuyển hướng đến trang 'home'
                return redirect()->route('fe.home'); // Thay 'home' bằng tên route mong muốn
            } else {
                // Đăng nhập thất bại, hiển thị thông báo lỗi
                return redirect()->route('fe.login')->with('error', 'Đăng nhập không thành công. Vui lòng kiểm tra lại thông tin đăng nhập.');
            }
        }

        // Nếu là GET request, hiển thị form đăng nhập
        return view('fe.pages.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('fe.home');
    }

    public function register(Request $request)
    {
        if($request->isMethod('post')) {
            $this->validate($request, [
                "fullname" => "required|string|max:32",
                "dob" => "required|date|before_or_equal:today",
                "phone" => "required|numeric|digits_between:6,12",
                "address" => "required|string|max:255",
                "email" => "required|email|unique:account,email",
                "username" => "required|string|min:6|max:15|unique:account,username",
                "pass" => "required|string|min:8|max:50|confirmed",
                "profile_image" => "image|mimes:jpeg,bmp,png,gif,jpg|max:50096"
            ]);
            $acc = new CarAccount();
            $acc->fullname = $request->fullname;
            $acc->dob = $request->dob;
            $acc->phone = $request->phone;
            $acc->address = $request->address;
            $acc->email = $request->email;
            $acc->username = $request->username;
            $acc->password = bcrypt($request->pass);
            $acc->role_value = 2;
            $acc->status = 1;
            if ($request->hasFile("profile_image")) {
                $img = $request->file("profile_image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/profile_image/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $acc->profile_image = $nameimg;
            } else {
                $acc->profile_image = "default-profile-image.jpg";
            }
            $acc->save();
            return redirect()->route('fe.login');
        }
        return view('fe.pages.register');
    }




}