<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\CarRating;

class CarAccount extends Authenticatable
{
    use  HasFactory, Notifiable;
    protected $table = "account";
    protected $fillable = ["fullname", "dob", "address", "phone", "email ","username", "password", "profile_image", "role_value", "status", "remember_token	", "created_at", "updated_at"];
    protected $primarykey = "id";
    public $timestamps = true;
    public function ratings()
    {
        return $this->hasMany(CarRating::class, 'account_id');
    }
}