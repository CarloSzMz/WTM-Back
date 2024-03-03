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
        'article_id',
        'user_id',
    ];

    // Relación con tabla "users"
    public function users()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con tabla "articles"
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relación con tabla "order_lines"
    public function order_lines()
    {
        return $this->hasMany(Order_Line::class);
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
