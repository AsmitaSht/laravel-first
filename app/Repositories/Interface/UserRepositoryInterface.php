<?php

namespace App\Repositories\Interface;

use App\Models\User;

Interface UserRepositoryInterface
{
    public function store($data);
    public function update(User $user, array $data);
    //public function delete($data);

}
