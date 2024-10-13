<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stichoza\GoogleTranslate\GoogleTranslate;

class Stage extends Model
{
    use HasFactory;
    protected $fillable=['name', 'notice'];

    public static function translate($model)
    {
        $tr = new GoogleTranslate(app()->getLocale());
        $model->name = $tr->translate($model->name);
        $model->notice = $tr->translate($model->notice);

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
    

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

}
