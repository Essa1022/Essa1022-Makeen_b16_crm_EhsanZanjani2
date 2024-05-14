<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
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
