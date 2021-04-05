<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserTeamProjectRepository extends BaseRepository implements UserTeamProjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\UserTeamProject::class;
    }
}
