<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarProduct;
use App\Models\CarCategory;
use Session;
use AgeekDev\Barcode\Facades\Barcode;
use AgeekDev\Barcode\Enums\Type;

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
                "capacity" => "required",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                "image" => "required|mimes:jpeg,png,gif,jpg,ico|max:50096",
                'thumbnail.*' => 'image|mimes:jpeg,bmp,png,gif,jpg|max:50096', // nhiều ảnh phải thêm dấu . và *

            ]);
            $Product = new CarProduct();
            $barcodeValue = $this->generateBarcode();
            $Product->barcode = $barcodeValue;
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->capacity = $request->capacity;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;

            // lấy dữ liệu của image
            if ($request->hasFile("image")) {
                $img = $request->file("image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/products/imagesPro/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->image = $nameimg;

            }
            // nhiều hình
            if ($request->hasfile('thumbnail')) {
                foreach ($request->file('thumbnail') as $file) {
                    $name = time() . '_at.' . $file->getClientOriginalName();
                    $file->move('public/be/images/products/thumbnail/', $name);
                    $image[] = $name;

                }
                $Product->thumbnail = json_encode($image);
            }
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
                "capacity" => "required",
                "price" => "required|numeric",
                "overview" => "required",
                "color" => "required",
                "image" => "required|mimes:jpeg,png,gif,jpg,ico|max:50096",

            ]);
            $Product = CarProduct::find($id);
            $barcodeValue = $this->generateBarcode();
            $Product->barcode = $barcodeValue;
            $Product->brand = $request->brand;
            $Product->name = $request->name;
            $Product->year = $request->year;
            $Product->capacity = $request->capacity;
            $Product->overview = $request->overview;
            $Product->price = $request->price;
            $Product->color = $request->color;
            // lấy dữ liệu của image
            if ($request->hasFile("image")) {
                $img = $request->file("image"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/products/imagesPro/' . $data["load"]->image); // sau khi update hình mới xoá hình cũ
                $img->move('public/be/images/products/imagesPro/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $Product->image = $nameimg;

            } else {
                $Product->image = $data["load"]->image;
            }
            // nhiều hình
            if($request->hasfile('thumbnail')) {
            	if($Product->thumbnail!=""){
	            	foreach (json_decode($Product->thumbnail) as $key) {
	            		@unlink('public/be/images/products/thumbnail/'.$key);
	            	}
            	}
	            foreach($request->file('thumbnail') as $file){
	                $name=time().'_at.'.$file->getClientOriginalName();
	                $file->move('public/be/images/products/thumbnail/',$name); 
	                $image[] = $name;
                    
	            }
	            $Product->thumbnail=json_encode($image);
			}

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
            @unlink('public/be/images/products/imagesPro/' . $load->image); // xoá hình
            CarProduct::destroy($id); // xoá thông tin
            Session::flash("note", "Delete Product Success");
            return redirect()->route('be.product'); // xoá xong về trang chủ
        } catch (\Throwable $th) {
            return redirect()->route('be.product');
        }

    }

    // create barcode
    private function generateBarcode()
    {
        $barcode = Barcode::imageType("svg")
            ->foregroundColor("#000000")
            ->height(30)
            ->widthFactor(2)
            ->type(Type::TYPE_CODE_128)
            ->generate("081231723897");

        // Lưu hoặc sử dụng mã vạch theo nhu cầu của bạn
        // Ví dụ: Lưu vào thư mục public/file/barcode và trả về đường dẫn của file
        $filename = 'barcode_' . time() . '.svg';
        $barcodePath = public_path('be/images/barcodes');

        if (!file_exists($barcodePath)) {
            mkdir($barcodePath, 0755, true);
        }

        file_put_contents($barcodePath . '/' . $filename, $barcode);

        return $filename;
    }

}
