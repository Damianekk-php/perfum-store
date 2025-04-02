<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image_path',
      'name',
      'description',
      'amount',
      'price',
        'category_id'


    ];

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function isSelectedCategory(int $category_id): bool
    {
        return $this->hasCategory() && $this->category->id == $category_id;
    }

    public function hasCategory(): bool
    {
        return !is_null($this->category);
    }


}
