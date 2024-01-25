<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarProduct extends Model
{
    protected $table = "cars";
    protected $fillable = ["type_id", "brand", "name", "color", "color_id", "barcode", "year", "capacity", "price", "overview", "thumbnail", "image", "created_at", "updated_at", "product_status"];
    protected $primarykey = "id";
    public $timestamps = false;
}
