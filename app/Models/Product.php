<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [

        "product_name",
        "category_id",
        "brand_id",
        "warranty_id",
        "price",
        "description"
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class)
        ->using(OrderProduct::class)
        ->withPivot('quantity','warranties');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function warranties(): BelongsToMany
    {
        return $this->belongsToMany(Warranty::class);
    }

    public function labels(): MorphToMany
    {
        return $this->morphToMany(Label::class, 'labelable');
    }
}
