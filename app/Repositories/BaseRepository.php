<?php

namespace App\Repositories;


abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getList($data)
    {
        $list = $this->model;
        $limit = $data['limit'] ?? LIMIT_PAGE;
        $pagination = filter_var($data['pagination'] ?? false, FILTER_VALIDATE_BOOLEAN);
        if ($pagination) {
            return $list->paginate($limit);
        }
        return $list->take($limit)->latest()->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $model = $this->find($id);
        if ($model) {
            $model->update($attributes);
            return $model;
        }
        return false;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        if ($model) {
            $model->delete();
            return true;
        }
        return false;
    }
}
