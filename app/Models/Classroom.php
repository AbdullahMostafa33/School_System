<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        $model->grade->statge->name = $tr->translate($model->grade->statge->name);
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
}
