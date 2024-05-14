<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Factor extends Model
{
    use HasFactory;

    protected $fillable = [
        "total_amount",
        "status",
        "order_id",
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function user(): HasOneThrough
    {
        return $this->hasOneThrough(User::class, Order::class);
    }
}
