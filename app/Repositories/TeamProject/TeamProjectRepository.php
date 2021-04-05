<?php
namespace App\Repositories\TeamProject;

use App\Repositories\BaseRepository;

class TeamProjectRepository extends BaseRepository implements TeamProjectRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\TeamProject::class;
    }

    public function getTeamProjects($data)
    {
        $users = $this->model;
        $limit = $data['limit'] ?? LIMIT_PAGE;
        $pagination = filter_var($data['pagination'], FILTER_VALIDATE_BOOLEAN);
        if ($pagination) {
            return $users->paginate($limit);
        }
        return $users->take($limit)->latest()->get();
    }
}
