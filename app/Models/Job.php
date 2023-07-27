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
        'successful_inspections_required',
        'is_available',
    ];


    // Validators

    public function hasExtensions(): bool
    {
        return (bool) $this->extensions->count();
    }

    
    // Relationships

    public function extensions()
    {
        return $this->belongsToMany(Extension::class, 'extension_job', 'job_id', 'api_extension_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
