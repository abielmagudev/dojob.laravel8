<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'is_available',
        'api_extension_info',
        'api_extension_id',
    ];
    
    public function api()
    {
        return $this->belongsTo(ApiExtension::class, 'api_extension_id');
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
