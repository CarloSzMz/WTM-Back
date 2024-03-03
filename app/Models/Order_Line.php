<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order_Line extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "order_lines";

    protected $fillable = [
        'status',
        'user_id',
    ];

    // Relación con tabla "orders"
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
