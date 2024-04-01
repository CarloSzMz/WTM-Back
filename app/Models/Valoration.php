<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Valoration extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "valorations";

    protected $fillable = [
        'description',
        'status',
        'order_id',
    ];

    // Relación con tabla "orders"
    public function orders()
    {
        return $this->belongsTo(Order::class);
    }
}
