<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'products',
        'total_price',
        'payment_status'
    ];

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'payment_status');
    }

//    public function product(): BelongsTo
//    {
//        return $this->belongsTo(Product::class, '');
//    }
}
