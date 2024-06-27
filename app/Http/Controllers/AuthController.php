<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return 'This login Page';
    }

    public function register(StoreRequest $storeRequest)
    {
        $storeRequest->validated($storeRequest->all());
        $user = User::create([
            'name' => $storeRequest->name,
            'email' => $storeRequest->email,
            'password' => Hash::make($storeRequest->password)

        ]);
        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of ' . $user->name)->plainTextToken
        ]);
    }



    public function logout()
    {
        return response()->json('This Logout Page');
    }
}
