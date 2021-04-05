<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUsers($data)
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
