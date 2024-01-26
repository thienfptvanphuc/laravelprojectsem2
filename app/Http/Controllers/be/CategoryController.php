<?php

namespace App\Http\Controllers\be;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarCategory;
use Session;


class CategoryController extends Controller
{
    //index
    public function index()
    {
        $data['cate'] = CarCategory::get();  // lấy tất cả record
        return view("be/pages/cars/category/index", $data);
    }

    // Add Function
    public function add(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required",
                "image_type" => "required|mimes:jpeg,png,gif,jpg,ico|max:4096",
                "description" => "required",
            ]);
            // lấy giá trị người dùng nhập vào các ô
            $cate = new CarCategory();
            $cate->name = $request->name;
            $cate->description = $request->description;
            // lấy dữ liệu của image
            if ($request->hasFile("image_type")) {
                $img = $request->file("image_type"); // lay ten anh
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                $img->move('public/be/images/categories/', $nameimg); // move iamge: luu hinh trong thu muc public/file/image
                // gán tên hình của ảnh vào cột image
                $cate->image_type = $nameimg;
            }
            $cate->type_status = $request->type_status;
            $cate->save();
            Session::flash("note", "Add Category Successfully");
            return redirect()->route("be.category");
        } else {
            return view("be/pages/cars/category/add");
        }
    }

    // Edit Function
    public function edit(Request $request, $id)
    {
        $data["load"] = CarCategory::find($id);
        if ($request->isMethod("post")) {
            // edit data
            $this->validate($request, [
                "name" => "required",
                "image_type" => "mimes:jpeg,png,gif,jpg,ico|max:4096",
                "description" => "required",
            ]);
            $cate = CarCategory::find($id);
            $cate->name = $request->name;
            $cate->description = $request->description;
            // Get image data
            if ($request->hasFile("image_type")) {
                $img = $request->file("image_type"); // give me your name
                $nameimg = time() . "_" . $img->getClientOriginalName(); // vd: 849883_hinh.jpg
                @unlink('public/be/images/categories/' . $data["load"]->image_type); // After updating the new image, delete the old image
                $img->move('public/be/images/categories/', $nameimg); // move iamge: save image in public/file/image folder
                // assign the image name of the image to the image column
                $cate->image_type = $nameimg;

            } else {
                $cate->image_type = $data["load"]->image_type;
            }
            $cate->type_status = $request->type_status;
            $cate->save();
            Session::flash("note", "Edited Successfully");
            return redirect()->route("be.category");

        } else {
            return view("be/pages/cars/category/edit", $data);
        }

    }

    //Delete Function
    public function del($id)
    {
        // Kiểm tra sự tồn tại của sản phẩm trong danh mục
        $cate = CarCategory::find($id);

        if ($cate === null) {
            // Xử lý trường hợp không tìm thấy đối tượng
            Session::flash("note", "Category not found");
            return redirect()->route("be.category");
        }

        // Tiếp tục xử lý nếu đối tượng tồn tại
        if ($cate->products->count() > 0) {  // products được khai báo quan hệ vs bảng category và product bên Model CarCategory
            // Nếu có sản phẩm, không cho phép xóa
            Session::flash("note", "Cannot delete category with associated products");
            return redirect()->route("be.category");
        }
        // Xóa danh mục
        $cate->delete();
    
        Session::flash("note", "Deleted Successfully");
        return redirect()->route("be.category");
        // try {
        //     // Lấy đường dẫn của hình ảnh và kiểm tra xem có tồn tại không
        //     $imagePath = public_path('public/be/images/categories/' . $cate->image);
        //     if (file_exists($imagePath)) {
        //         // Nếu tồn tại, thì xóa hình ảnh
        //         @unlink($imagePath);
        //     }
    
        //     // Xóa danh mục
        //     $cate->delete();
    
        //     Session::flash("note", "Deleted Successfully");
        //     return redirect()->route("be.category");
        // } catch (\Throwable $th) {
        //     return redirect()->route('be.category');
        // }
        
    }
   

}
