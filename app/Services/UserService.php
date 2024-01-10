<?php

namespace App\Services;

use App\Repositories\TicketRepository;
use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function getAllUser()
    {
        return $this->userRepository->getAllUser();
    }

    public function addUserExpAfterFinishEvent($userId, $totalAddExp)
    {
        return $this->userRepository->addExp($userId, $totalAddExp);
    }
}