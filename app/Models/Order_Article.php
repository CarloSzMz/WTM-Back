<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Order_Article extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "orders_articles";

    protected $fillable = [
        'order_id',
        'article_id',
        'quantity',
    ];

    // Relación con tabla "orders"
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    // Relación con tabla "articles"
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
