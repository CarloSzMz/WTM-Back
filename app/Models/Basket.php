<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Basket extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "basket";

    protected $fillable = [
        'quantity',
        'total',
        'article_id',
        'user_id',
    ];

    // Relación con tabla "articles"
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    // Relación con tabla "users"
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
