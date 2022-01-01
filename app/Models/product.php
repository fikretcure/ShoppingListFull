<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function get_user()
    {
        return $this->hasMany(in_basket::class, "products_id", "id");
    }
}
