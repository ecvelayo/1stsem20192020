<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    use Notifiable;

    use SoftDeletes;

    const USER_TYPE_ADMIN = 'admin';
    const USER_TYPE_STUDENT = 'student';
    const USER_TYPE_ADVISER = 'adviser';
    const USER_TYPE_FACULTY = 'faculty';

    const USER_DEFAULT_PASSWORRD = 'usc2018!*';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'middle_initial',
        'title',
        'idnumber',
        'contact_number',
        'username',
        'password',
        'user_role'
    ];

    protected $appends = ['fullname'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Undocumented function
     *
     * @param string $userRole
     * @return boolean
     */
    public function isRole(string $userRole)
    {
        return $this->user_role === $userRole;
    }

    public function getFullnameAttribute()
    {
        return "{$this->lastname}, {$this->firstname} {$this->middle_initial}.";
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('user_role', $type);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_authors', 'author_id', 'project_id');
    }

    public function relatedProjects() {
    return $this->hasMany('App\Project', 'adviser_id');
}

    public function handledProjects()
    {
        return $this->hasMany(Project::class, 'adviser_id');
    }

    public function chairPaneledProjects()
    {
        return $this->hasMany(Project::class, 'chair_panel_id');
    }

    public function paneledProjects()
    {
        return $this->hasMany(ProjectPanel::class, 'panel_id');
    }
}