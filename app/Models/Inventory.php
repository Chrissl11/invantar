<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //protected $table = 'inventories';
    //protected $primaryKey = 'id';

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
