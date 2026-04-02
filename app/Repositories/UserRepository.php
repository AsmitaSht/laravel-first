<?php
namespace App\Repositories;
use App\Models\User;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function store($data){
        return User::create($data);
    }

    public function update(User $user,array $data){
        $user->update($data);
        return $user;
    }

    // public function destroy(User $user){

    // }
}
?>