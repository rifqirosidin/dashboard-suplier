<?php

namespace App\Repositories;

use App\Models\Role;
use App\User;

class UserRepository {

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getRole()
    {
        return Role::all();
    }
}
