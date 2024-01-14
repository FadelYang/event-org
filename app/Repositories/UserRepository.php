<?php

namespace App\Repositories;

use App\Models\payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{
    public function getAllUser()
    {
        return User::all();
    }

    public function getUserById($userId)
    {
        return User::where('id', $userId)->first();
    }

    public function addExp($userId, $totalAddExp)
    {
        return $this->getUserById($userId)->update([
            'exp' => $totalAddExp
        ]);
    }
}