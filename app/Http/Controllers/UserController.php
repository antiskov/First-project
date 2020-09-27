<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * @param User $user
     * @return Application|Factory|View
     */
    public function userPage(User $user)
    {
        return view('user_profile', ['user' => $user]);
    }
}
