<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'timezone',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'profile_photo_url',
        'is_admin',
        'is_simran',
    ];

    /** Relationships */
    public function missedMeetings()
    {
        return $this->hasMany(MissedMeeting::class);
    }

    /** Attributes */
    public function getIsAdminAttribute()
    {
        return auth()->check() ? in_array(auth()->user()->email, [
            config('horizon.allowed_user_email'),
        ]) : false;
    }

    public function getIsSimranAttribute()
    {
        return $this->id == 1;
    }
}
