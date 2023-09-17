<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getListUser($inputs)
    {
        return $this->query($inputs)->paginate(self::PAGINATE);
    }

}
