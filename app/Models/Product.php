<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string|null $product_name
 * @property string|null $product_number
 */
class Product extends Model
{
//TODO massenzuweisung Codedublikat zusammenfassen -> ProductsController -> methode store und update
    protected $fillable = [
        'product_id',
        'product_name',
        'product_number',
        'product_purchasePrice',
        'product_residualValue',
        'product_description',
        'inventory_id',
        'status_id',
        'usage_start_date',
        'usage_end_date',
    ];

    public function inventory(): BelongsTo
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
}
