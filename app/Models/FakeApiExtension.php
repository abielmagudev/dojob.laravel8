<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeApiExtension extends Model
{
    use HasFactory;

    protected $table = 'fake_api_extensions';
    
    protected $fillable = [
        'name',
        'classname',
        'description',
        'tags_csv_format',
        'price',
    ];

    // Attributes

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
