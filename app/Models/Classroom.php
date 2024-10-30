<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PHPUnit\Event\Code\Test;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'grade_id'];

    public static function translate($model)
    {
        $tr = new GoogleTranslate(app()->getLocale());
        $model->name = $tr->translate($model->name);
        $model->grade->name = $tr->translate($model->grade->name);
        $model->grade->stage->name = $tr->translate($model->grade->stage->name);
        return $model;
    }

    // Override  all() method
    public static function all($columns = ['*'])
    {
        $models = parent::all();

        if (app()->getLocale() != 'en') {
            foreach ($models as $model) {
                $model = self::translate($model);
            }
        }

        return $models;
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function specialties(){
        return $this->belongsToMany(Specialty::class, 'classroom_specialty_teacher')->withPivot('teacher_id');
    }

    public function teacher($id)
    {
       return Teacher::find($id);
    }

}
