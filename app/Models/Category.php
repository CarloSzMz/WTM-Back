<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Category extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "categories";

    protected $fillable = [
        'name',
    ];

    // Relación con tabla "articles"
    public function articles()
    {
        return $this->belongsTo(Article::class);
    }
}
