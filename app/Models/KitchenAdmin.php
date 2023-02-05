<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitchenAdmin extends Model
{
    use HasFactory;

   protected $guarded = [];
   protected $fillable = ["name","email","phone","admin_type","is_active","password","kitchen_id"];
	protected $table = 'kitchen_admins';
}
