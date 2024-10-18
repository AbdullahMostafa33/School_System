<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'password',
        'name',
        'gender',
        'national_id',
        'address',
        'phone',
        'religion',
        'nationality',
        'parent_id',
        'classroom_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Parents::class, 'parent_id');
    }

    public function classroom()  {
        return $this->belongsTo(Classroom::class,'classroom_id');
    }

}
