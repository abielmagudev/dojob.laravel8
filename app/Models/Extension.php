<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'api_extension_id';

    protected $fillable = [
        'api_extension_id',
        'name',
        'classname',
        'description',
    ];

    
    // Attributes

    public function getApiIdAttribute()
    {
        return $this->api_extension_id;
    }

    public function getInitialsNameAttribute()
    {
        $words = explode(' ', $this->name);

        $initials_name = array_map(function ($word) {
            return ctype_alpha($word[0]) ? $word[0] : '';
        }, $words);

        return implode($initials_name);
    }

    public function getControllerClassAttribute()
    {
        return sprintf('App\\Http\\Controllers\\ApiExtensions\\%sController', $this->classname);
    }

    public function getModelClassAttribute()
    {
        return sprintf('%s\\ApiExtensions\\%s', __NAMESPACE__, $this->classname);
    }

    public function getFormRequestClass(string $form_request_name)
    {
        return sprintf('App\\Http\\Requests\\ApiExtensions\\%s\\%s', $this->classname, $form_request_name);
    }


    // Relations

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

    public function fakeApi()
    {
        return $this->belongsTo(FakeApiExtension::class, 'api_extension_id');
    }
}
