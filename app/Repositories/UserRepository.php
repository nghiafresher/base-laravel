<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function getFieldsSearchable()
    {
        // TODO: Implement getFieldsSearchable() method.
    }
    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getListUser(array $inputs)
    {

    }
}
