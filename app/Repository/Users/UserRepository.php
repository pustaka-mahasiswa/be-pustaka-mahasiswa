<?php

namespace App\Repository\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    private User $user;

    /**
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function findByUsername(string $username): object
    {
        return $this->user->where('username', $username)->first();
    }

    public function create(array $data): bool
    {
        $data['password'] = Hash::make($data['password']);
        $this->user->create($data);

        return true;
    }
}
