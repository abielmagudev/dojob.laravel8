<?php

namespace App\Models;

use App\Models\Kernel\Traits\HasExistence;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use HasExistence;

    protected $table = 'orders';
    
    protected $fillable = [
        'job_id',
        'notes',
        'scheduled_date',
        'scheduled_time',
    ];
    

    // Attributes

    public function getFullScheduledAttribute()
    {
        return sprintf('%s %s', $this->scheduled_date, $this->scheduled_time);
    }

    public function getFullScheduledHumanAttribute()
    {
        return Carbon::parse( $this->full_scheduled )->toDayDateTimeString();
    }

    public function getScheduledDateHumanAttribute()
    {
        return Carbon::parse($this->scheduled_date)->format('D, M d, Y');
    }

    public function getScheduledTimeHumanAttribute()
    {
        return Carbon::parse($this->scheduled_time)->format('h:i A');
    }


    // Scopes

    public function scopeWhereJobsAvailable($query)
    {
        return $query->whereIn('job_id', 
            (Job::all('id')->pluck('id')->toArray())
        );
    }


    // Relationships

    public function job()
    {
        return $this->belongsTo(Job::class)->orderBy('name');
    }
}
