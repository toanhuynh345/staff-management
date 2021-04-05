<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTeamProject extends Model
{
    protected $fillable = [
        'user_id', 'team_project_id', 'start_join', 'end_join'
    ];

}
