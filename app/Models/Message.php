<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Message extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    public $timestamps = false;
    protected $fillable = [
        "description",
        "ticket_id"
    ];
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
