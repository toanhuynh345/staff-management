<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamProject extends Model
{
    protected $fillable = [
        'id', 'name', 'department_id', 'project_id'
    ];

}
