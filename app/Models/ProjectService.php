<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectService extends Model
{
    use HasFactory;
    protected $table = 'project_service';

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }
}
