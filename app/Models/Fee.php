<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $fillable=['name','cost', 'stage_id','grade_id','notes','year'];

    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
