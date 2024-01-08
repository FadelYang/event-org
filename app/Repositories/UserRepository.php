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
}