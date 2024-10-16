<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'name',
        'address',
        'phone',
        'gender',
        'religion',
        'nationality_id',
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
