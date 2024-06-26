<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Article extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "articles";

    protected $fillable = [
        'name',
        'description',
        'url_img',
        'stock_id',
        'category_id',
    ];

    // Relación con tabla "stock"
    public function stock()
    {
        return $this->hasOne(Stock::class);
    }

    // Relación con tabla "basket"
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    // Relación con tabla "category"
    public function category()
    {
        return $this->hasMany(Category::class);
    }

    // Relación con tabla "orders_articles"
    public function orders_articles()
    {
        return $this->hasMany(Order_Article::class);
    }
}
