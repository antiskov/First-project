<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoard;
use App\Topic;
use App\Board;
use App\Thread;
use Exception;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class BoardController
 * @package App\Http\Controllers
 */
class BoardController extends Controller
{

    /**
     * @param Thread $thread
     * @return ApplicationAlias|Factory|View
     */
    public function getAll(Thread $thread)
    {

        return view('board', [
            'boards' => $thread->load('boards')->boards,
            'thread' => $thread,
        ]);
    }

    /**
     * @param Thread $thread
     * @return ApplicationAlias|Factory|View
     */
    public function getAllForAdmin(Thread $thread)
    {
        return view('admin.admin_boards', [
            'boards' => $thread->load('boards')->boards,
            'thread' => $thread
        ]);
    }

    /**
     * @param Thread $thread
     * @param StoreBoard $request
     * @return RedirectResponse
     */
    public function set(Thread $thread, StoreBoard $request)
    {
        $board = new Board($request->all());
        $board->user()->associate(auth()->user());
        $board->thread()->associate($thread);
        $board->save();

        return redirect()->route('board', [$thread->id]);

    }

    /**
     * @param Thread $thread
     * @param Board $board
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete(Thread $thread, Board $board)
    {
        $board->delete();

        return redirect()->route('board', [$thread->id]);
    }

    public function deleteForAdmin(Thread $thread, Board $board)
    {
        $board->delete();

        return redirect()->route('admin-board', [$thread->id]);
    }

    /**
     * @param Thread $thread
     * @param Board $board
     * @return RedirectResponse
     */
    public function forceDelete(Thread $thread, Board $board)
    {
        $board->forceDelete();

        return redirect()->route('admin-board', [$thread->id]);
    }

    /**
     * @param $board
     * @return RedirectResponse
     */
    public function restore($board)
    {
        Board::withTrashed()->find($board)->restore();

        return redirect()->route('soft-deleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'threads' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
