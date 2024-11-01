<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'title', 'meeting_zoom_id', 'duration', 'start_at', 'start_url', 'join_url', 'grade_id', 'classroom_id', 'specialty_id', 'created_by'];
    
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }
}
