<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'is_available',
    ];


    // Validators

    public function hasExtensions()
    {
        return (bool) $this->extensions->count();
    }

    // Relationships

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function extensions()
    {
        return $this->belongsToMany(Extension::class);
    }
}
