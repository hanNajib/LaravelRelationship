<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the product for the Category
     * Pakai hasMany kalo foreign key berada di model yang direlasikan
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id', 'id');  // category_id dari foreign key yang ada di Product dan id dari id category
    }
}
