<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = "users";


    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'calle',
        'provincia',
        'tipo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relación con tabla "basket"
    public function basket()
    {
        return $this->hasMany(Basket::class);
    }
    // Relación con tabla "orders"
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
