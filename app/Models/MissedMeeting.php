<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MissedMeeting extends Model
{
    use HasFactory;

    protected $appends = [
        'created_at_local_timezone',
        'created_at_diff_for_humans',
    ];

    protected $fillable = [
        'id',
        'user_id',
    ];

    protected $tz;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->tz = auth()->user()->timezone ?? 'America/Chicago';
    }


    /** Relationships */

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /** Attributes */

    public function getCreatedAtLocalTimezoneAttribute()
    {
        return $this->created_at->timezone($this->tz)->format('F jS Y @ g:i a');
    }

    public function getCreatedAtDiffForHumansAttribute()
    {
        return $this->created_at->diffForHumans(null, null, false, 3);
    }


    /** Scopes */

    public function scopeToday($query)
    {
        return $query->where('created_at', '>', now()->timezone($this->tz)->startOfDay()->utc());
    }

    public function scopeThisWeek($query)
    {
        return $query->where('created_at', '>', now()->timezone($this->tz)->startOfWeek()->utc());
    }

    public function scopeThisMonth($query)
    {
        return $query->where('created_at', '>', now()->timezone($this->tz)->startOfMonth()->utc());
    }

    public function scopeDaysSinceLast($query)
    {
        return $query->latest()->first()->created_at->timezone($this->tz)->startOfDay()->utc()->diffInDays();
    }
}
