<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPasswordNotification;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','job_title', 'user_status', 'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function teamprofile() 
    {
        return $this->hasOne('App\teamprofile');
    }

    public function roles() 
    {
        return $this->belongsToMany('App\Role', 'role_users');
    }

    public function profileattributes() 
    {
        return $this->belongsToMany('App\profileattribute', 'profile_attributes_users')->withPivot('value');
    }

    public function profilesocialmedias() 
    {
        return $this->belongsToMany('App\profilesocialmedia', 'profilesocialmedias_users')->withPivot('link');
    }

    public function images() 
    {
        return $this->morphToMany('App\Image', 'imageable');
    }

    public function inRole($slug)
    {
        return $this->roles()->where('slug',$slug)->count()==1;
    }

    public function hasAccess(array $permissions)
    {
        foreach($this->roles as $role)
        {
            if($role->hasAccess($permissions))
            {
                return true;
            }
        }
        return false;
    }
}
