<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Authenticatable
{
    use HasFactory,Notifiable,HasApiTokens;
    protected $fillable = [
        'email',
        'password',
        'name',
        'address',
        'phone',
        'gender',
        'religion',
        'nationality',
        'national_id',
        'join_at',
    ];

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }
    protected $casts = [
    'join_at' => 'date',
];
}
