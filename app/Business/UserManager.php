<?php 

namespace App\Business;

use App\Models\User;

class UserManager
{
    public function getList()
    {
        return User::all();
    }

}