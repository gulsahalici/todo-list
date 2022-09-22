<?php 

namespace App\Business;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManager
{
    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $user;
    }


    public function login(array $data)
    {
        if(!Auth::attempt($data)) {
            return false;
        }

        $user = User::where('email', $data['email'])->first();

        return $user;
    }

}