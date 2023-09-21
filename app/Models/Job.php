<?php

namespace App\Models;

use App\Models\Kernel\Traits\HasExistence;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use HasFactory;
    use HasExistence;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'successful_inspections_required',
        'is_available',
    ];


    // Validators

    public function hasExtensions(): bool
    {
        return (bool) ($this->extensions_count ?? $this->extensions->count());
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
