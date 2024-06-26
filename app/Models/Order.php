<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "status",
        "total_amount",
        "payment_method",
        "address",
        "description"
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)
        ->using(OrderProduct::class)
        ->withPivot('quantity','warranties');
    }

    public function factor(): HasOne
    {
        return $this->hasOne(Factor::class);
    }

    public function warranties(): HasManyThrough
    {
        return $this->hasManyThrough(Warranty::class, Product::class);
    }
}
