<?php

namespace App\Http\Controllers;

use App\{Board, Topic, Tred};

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.admin_panel', ['topics' => Topic::all()]);
    }

    public function softDeleted()
    {
        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
