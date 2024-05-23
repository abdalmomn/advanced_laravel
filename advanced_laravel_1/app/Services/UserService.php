<?php
namespace App\Services;

use App\Events\MailRegisterEvent;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;

class UserService {
    public function createUser($data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return $user;

    }
}

