<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = "rental";
    protected $fillable = ["car_id", "account_id", "pickup_date", "return_date","customer_name", 
                            "processing","status"];
    protected $primarykey = "id";
    public $timestamps = true;
}
