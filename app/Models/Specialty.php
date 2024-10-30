<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','stage_id','grade_id'
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class,'specialty_teacher');
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
