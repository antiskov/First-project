<?php

namespace App\Http\Controllers;

use App\{Board, Topic, Tred};

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        return view('admin.admin_panel', ['topics' => Topic::all()]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function softDeleted()
    {
        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
