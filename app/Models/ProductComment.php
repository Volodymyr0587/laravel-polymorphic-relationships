<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductComment extends Model
{
    protected $fillable = ['product_id', 'comment'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
