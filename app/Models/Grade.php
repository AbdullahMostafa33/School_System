<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'notice', 'stage_id'];

    public static function translate($model){
        $tr = new GoogleTranslate(app()->getLocale());
        $model->name = $tr->translate($model->name);
        $model->stage->name = $tr->translate($model->stage->name);
        $model->notice = $tr->translate($model->notice);

        return $model;
    }

    // Override  all() method
    public static function all($columns = ['*'])
    {
        $models = parent::all();
       
        if(app()->getLocale()!='en'){
            foreach ($models as $model) {
                $model = self::translate($model);
            }
        }

        return $models;
    }

    public function stage (){
        return $this->belongsTo(Stage::class);
    }
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
