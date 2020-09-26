<?php

namespace App\Http\Controllers;

use App\Topic;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin_panel', ['topics' => Topic::all()]);
    }
}
