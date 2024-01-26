<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CarRating;


class CarProduct extends Model
{
    protected $table = "cars";
    protected $fillable = ["type_id", "brand", "name", "color", "color_id", "barcode", "year", "seats", "price", "overview", "thumbnail", "image", "created_at", "updated_at", "product_status"];
    protected $primarykey = "id";
    public $timestamps = false;
    public function averageRating()
    {
        // Sử dụng phương thức avg để tính trung bình đánh giá
        return $this->ratings()->avg('stars_rated') ?? 0;
    }
    
    public function ratings()
    {
        return $this->hasMany(CarRating::class, 'car_id');
    }
}
