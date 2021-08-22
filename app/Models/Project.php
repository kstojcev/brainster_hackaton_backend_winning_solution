<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    public function images()
    {
        return $this->hasMany(Image::class, 'project_id');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'project_service');
    }
}
