<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parents extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',          // Fixed the typo 'eamil' to 'email'
        'password',
        'name',
        'address',
        'phone',
        'religion',
        'nationality',
        'national_id',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'parent_id');
    }
}
