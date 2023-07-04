<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class ApiExtension extends Model
{
    use HasFactory;

    // Attributes

    public function getInfoArrayAttribute()
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'model_class' => $this->model_class,
            'controller_class' => $this->controller_class,
        ];
    }

    public function getTagsArrayAttribute()
    {
        return str_getcsv($this->tags_csv_format);
    }

    
    // Scopes

    public function scopeHasTags($query, $tags)
    {
        return $query->where('tags_csv_format', 'like', "%{$tags}%");
    }
}
