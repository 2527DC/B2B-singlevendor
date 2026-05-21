<?php

namespace Modules\FrontendCMS\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Benifit extends Model
{
    use HasFactory , HasTranslations;

    protected $guarded = ['id'];
    protected $appends = ['translateName','TranslateDescription'];
    public $translatable = ['title','description'];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

    }
    public function getTranslateNameAttribute(){
        return isset($this->attributes['title']) ? $this->attributes['title'] : null;
    }
    public function getTranslateDescriptionAttribute(){
        return isset($this->attributes['description']) ? $this->attributes['description'] : null;
    }
}
