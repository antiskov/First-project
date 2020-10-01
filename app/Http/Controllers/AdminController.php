<?php

namespace App\Http\Controllers;

use App\{Board, Topic, Thread};
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
class AdminController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function admin()
    {
        return view('admin.admin_panel', ['topics' => Topic::all()]);
    }

    /**
     * @return Application|Factory|View
     */
    public function softDeleted()
    {
        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'threads' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
