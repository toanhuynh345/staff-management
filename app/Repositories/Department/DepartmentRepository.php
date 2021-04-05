<?php
namespace App\Repositories\Department;

use App\Repositories\BaseRepository;

class DepartmentRepository extends BaseRepository implements DepartmentRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Department::class;
    }

    public function getDepartments($data)
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
