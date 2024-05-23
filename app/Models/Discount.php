<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Discount extends Model
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "discount";

    protected $fillable = [
        'name',
        'discount',
        'active',
    ];

}
