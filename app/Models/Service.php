<?php

namespace App\Models;

use App\Http\Controllers\ProjectController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];

    public function projects()
    {
        return $this->hasMbeany(Project::class);
    }
}
