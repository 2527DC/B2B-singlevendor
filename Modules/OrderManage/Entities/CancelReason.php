<?php

namespace Modules\OrderManage\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CancelReason extends Model
{
    use HasFactory, HasTranslations;
    protected $table = "cancel_reasons";
    protected $guarded = ['id'];
    protected $appends = [];
    public $translatable = [];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (isModuleActive('FrontendMultiLang')) {
            $this->translatable = ['name','description'];
            $this->appends = ['translateName','TranslateDescription'];
        }
    }
    public function getTranslateNameAttribute(){
        return isset($this->attributes['name']) ? $this->attributes['name'] : null;
    }
    public function getTranslateDescriptionAttribute(){
        return isset($this->attributes['description']) ? $this->attributes['description'] : null;
    }
}
