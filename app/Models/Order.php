<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "orders";

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    // Relación con tabla "users"
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con tabla "orders_articles"
    public function orders_articles()
    {
        return $this->hasMany(Order_Article::class);
    }

    // Relación con tabla "valorations"
    public function valorations()
    {
        return $this->hasMany(Valoration::class);
    }

    // Relación con tabla "favorites"
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
