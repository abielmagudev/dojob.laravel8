<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use ReflectionClass;

class Extension extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'classname',
        'description',
    ];

    
    // Model attributes

    public function getModelPathAttribute()
    {
        return sprintf('%s\\ApiExtensions\\%s', __NAMESPACE__, $this->classname);
    }

    public function getModelAttribute()
    {
        return sprintf('%s\\%s', $this->model_path, $this->classname);
    }

    
    // Controller attributes

    public function getControllerPathAttribute()
    {
        return sprintf('App\\Http\\Controllers\\ApiExtensions\\%s', $this->classname);
    }

    public function getControllerAttribute()
    {
        return sprintf('%s\\%sController', $this->controller_path, $this->classname);
    }

    public function getControllerSettingsAttribute()
    {
        return sprintf('%s\\%sSettingsController', $this->controller_path, $this->classname);
    }


    // Form requests attributes

    public function getRequestsNamespaceAttribute()
    {
        return sprintf('App\\Http\\Requests\\ApiExtensions\\%s', $this->classname);
    }

    public function getFormRequest(string $form_request_name)
    {
        return sprintf('%s\\%s', $this->requests_namespace, $form_request_name);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
