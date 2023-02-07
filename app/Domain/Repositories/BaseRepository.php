<?php

namespace App\Domain\Repositories;

class BaseRepository
{

    /**
     * @return mixed
     */
    public function query()
    {
        return call_user_func(static::MODEL . '::query');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->query()->find($id);
    }

    /**
     * @param $ids
     * @param $columns
     * @return mixed
     */
    public function findMany($ids, $columns = ['*'])
    {
        return $this->query()->whereIn('id', $ids)->get($columns);
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->query()->get();
    }

    /**
     * @param $perPage
     * @param $columns
     * @return mixed
     */
    public function paginate($perPage = 10, $sortDesc = false, $columns = ['*'])
    {
        if($sortDesc){
            return $this->query()->orderByDesc('id')->paginate($perPage, $columns);
        }

        return $this->query()->paginate($perPage, $columns);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function insert(array $data)
    {
        return $this->query()->insert($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }
}
