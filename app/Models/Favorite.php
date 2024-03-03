<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Favorite extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "favorites";

    protected $fillable = [
        'order_id',
    ];

    // Relación con tabla "orders"
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
