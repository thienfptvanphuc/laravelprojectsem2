<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarProduct;
use App\Models\CarCategory;
use Session;
//thư viện QR_Code
use Endroid\QrCode\QrCode;
// use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductController extends Controller
{
    //Index
    public function index()
    {
        $data["product"] = CarProduct::get();
        return view("be/pages/cars/product/index", $data);
    }

    // Add Product
    public function add(Request $request)
    {

        if ($request->isMethod("post")) {
            $this->validate($request, [
                "brand" => "required",
                "name" => "required",
                "year" => "required",
                "seats" => "required",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                "thumbnail" => "required|mimes:jpeg,png,gif,jpg,ico|max:50096",
                'images.*' => 'image|mimes:jpeg,bmp,png,gif,jpg|max:50096', // nhiều ảnh phải thêm dấu . và *

            ]);
            $Product = new CarProduct();
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->seats = $request->seats;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;

            // lấy dữ liệu của image
            if ($request->hasFile("thumbnail")) {
                $img = $request->file("thumbnail"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/products/thumbnail/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->thumbnail = $nameimg;

            }
            // nhiều hình
            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $file) {
                    $name = time() . '_at.' . $file->getClientOriginalName();
                    $file->move('public/be/images/products/imagesPro/', $name);
                    $image[] = $name;

                }
                $Product->images = json_encode($image);
            }

            // Thêm vào để tạo qr_code
            $this->generateQRCode($Product->name, $Product->image, $Product->price*1000, $Product->brand, $Product->color);
            $Product->type_id = $request->type_id;
            $Product->created_at = now();
            $Product->updated_at = now();
            $Product->product_status = $request->product_status;
            $Product->save();
            Session::flash('note', 'Add Product Successfully');
            return redirect()->route("be.product");

        } else {
            //load category vào Product
            $data["dm"] = CarCategory::where("type_status", 1)->get(); // where lấy theo status = 1 còn hoạt động thì mới lấy vào để add
            return view("be/pages/cars/product/add", $data);
        }

    }

    //Edit 
    public function edit(Request $request, $id = null)
    {
        $data["load"] = CarProduct::find($id);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "brand" => "required",
                "name" => "required",
                "year" => "required",
                "seats" => "required",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                "thumbnail" => "required|mimes:jpeg,png,gif,jpg,ico|max:50096",

            ]);
            $Product = CarProduct::find($id);
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->seats = $request->seats;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;
            // lấy dữ liệu của image
            if ($request->hasFile("thumbnail")) {
                $img = $request->file("thumbnail"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/products/thumbnail/' . $data["load"]->thumbnail); // sau khi update hình mới xoá hình cũ
                $img->move('public/be/images/products/thumbnail/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->thumbnail = $nameimg;

            } else {
                $Product->thumbnail = $data["load"]->thumbnail;
            }
            // nhiều hình
            if ($request->hasfile('images')) {
                if ($Product->images != "") {
                    foreach (json_decode($Product->images) as $key) {
                        @unlink('public/be/images/products/imagesPro/' . $key);
                    }
                }
                foreach ($request->file('thumbnail') as $file) {
                    $name = time() . '_at.' . $file->getClientOriginalName();
                    $file->move('public/be/images/products/imagesPro/', $name);
                    $image[] = $name;

                }
                $Product->images = json_encode($image);
            }

            //chỉ cần thêm phương thức này vào hàm để cập nhật lại qr code theo các giá trị
            $this->generateQRCode($Product->name, $Product->thumbnail, $Product->price, $Product->brand, $Product->color);
            $Product->type_id = $request->type_id;
            $Product->created_at = now();
            $Product->updated_at = now();
            $Product->product_status = $request->product_status;
            $Product->save();
            Session::flash('note', 'Edit Product Success');
            return redirect()->route("be.product");

        } else {
            $data["dm"] = CarCategory::where("type_status", 1)->get();
            return view("be/pages/cars/product/edit", $data);
        }
    }


    // Delete
    public function del($id = null)
    {
        // bắt lỗi    
        try {
            $load = CarProduct::find($id);
            @unlink('public/be/images/products/thumbnail/' . $load->thumbnail); // xoá hình
            CarProduct::destroy($id); // xoá thông tin
            Session::flash("note", "Delete Product Success");
            return redirect()->route('be.product'); // xoá xong về trang chủ
        } catch (\Throwable $th) {
            return redirect()->route('be.product');
        }

    }

    // Create QR_Code
    private function generateQRCode($productName, $productPrice, $imageName, $imageBrand, $imageColor)
    {
        $companyName = "EASY CAR COMPANY LIMITED"; // Tên công ty cố định

        // Tạo một thể hiện mã QR mới
        $qrCode = new QrCode("$companyName\n\n$productName\n\nThumbnail: $imageName\n\n
            Price: $productPrice VND\n\nBrand: $imageBrand\n\nColor: $imageColor");

        // Lưu mã QR dưới dạng tệp hình ảnh
        $fileName = "product_$productName.png";

        // Xóa tệp tin cũ trước khi tạo QR code mới
        $oldQRCodePath = public_path("be/carqrcode/$fileName");
        $realPath = realpath($oldQRCodePath);

        if ($realPath && file_exists($realPath)) {
            unlink($realPath);
        }


        $qrCode->writeFile(public_path("be/carqrcode/$fileName"));

    }
    // Download QR
    public function downloadQRCode($filename)
    {
        $path = public_path("be/carqrcode/$filename");

        return response()->download($path);
    }

    // public function showProductDetail($id)
    // {
    //     // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    //     $product = CarProduct::find($id);

    //     // Kiểm tra xem sản phẩm có tồn tại không
    //     if (!$product) {
    //         // Xử lý khi không tìm thấy sản phẩm
    //         return redirect()->back()->with('error', 'Không tìm thấy sản phẩm.');
    //     }

    //     // Truyền biến $product vào view
    //     return view('fe.detail', compact('product'));
    // }

}
