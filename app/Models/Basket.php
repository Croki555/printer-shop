<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'product_id',
        'price',
        'quantity'
    ];

    public function product():BelongsTo
    {
        return  $this->belongsTo(Product::class);
    }
}
