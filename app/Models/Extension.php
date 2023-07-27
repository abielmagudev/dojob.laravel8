<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'api_extension_id',
        'name',
        'classname',
        'description',
    ];

    protected $primaryKey = 'api_extension_id';


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
