<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable=['student_id', 'amount', 'status', 'paid_at','notes'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function fees(){
        return $this->belongsToMany(Fee::class, 'invoice_fee')->withPivot('notes');
    }
}
