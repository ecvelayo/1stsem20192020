<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectPanel extends Model
{
	protected $table = 'project_panel';
    protected $fillable = [
        'panel_id',
        'project_id'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'project_id');
    }
}
