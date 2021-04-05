<?php
namespace App\Repositories\ProjectInfo;

use App\Repositories\BaseRepository;

class ProjectInfoRepository extends BaseRepository implements ProjectInfoRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Department::class;
    }

    public function getProjects($data)
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
