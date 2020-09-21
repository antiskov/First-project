<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userPage(User $user)
    {
        return view('user_profile', ['user' => $user]);
    }
}
