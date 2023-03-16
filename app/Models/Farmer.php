<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    use HasFactory;

   protected $guarded = [];
   protected $fillable = ["name","phone_number","password","address","upazila","district","is_active"];
	 protected $table = 'farmers';
}
