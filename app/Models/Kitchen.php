<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

   protected $guarded = [];
   protected $fillable = ["kitchen_name","address","is_active"];
	protected $table = 'kitchens';
}
