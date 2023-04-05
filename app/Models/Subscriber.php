<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

   protected $guarded = [];
   protected $fillable = ["name","email","phone","password","photo","unique_id","api_version","is_verified","is_active","is_google_login","is_deleted"];
	 protected $table = 'subscribers';
}
