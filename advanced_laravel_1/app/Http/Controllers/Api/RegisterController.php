<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\CreateUserValidator;
use App\Http\Requests\User\LoginUserValidator;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class RegisterController extends BaseController
{
    public UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(CreateUserValidator $createUserValidator)
    {
        $user = $this->userService->createUser($createUserValidator->validated());
        $message['user'] = $user;
        $message['token'] = $user->createToken('MyApp')->plainTextToken;
        return $this->sendResponse($message);
    }

    public function login(LoginUserValidator $loginUserValidator)
    {
        if (Auth::attempt(['email' => request()->email , 'password' => request()->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;
            return $this->sendResponse($success);
        }else{
            return $this->sendError('unauthorized');
        }
    }
}
