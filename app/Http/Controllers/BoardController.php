<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;
use App\Board;

class BoardController extends Controller
{
    public function board(Tred $tred)
    {

        return view('board', [
            'boards' => $tred->load('boards')->boards,
            'tred' => $tred,
        ]);
    }

    public function boardForAdmin(Tred $tred)
    {
        return view('admin.admin_boards', [
            'boards' => $tred->load('boards')->boards,
            'tred' => $tred,
        ]);
    }

    public function addBoard(Tred $tred, StoreContent $request)
    {
        $board = new Board($request->all());
        $board->user()->associate(auth()->user());
        $board->tred()->associate($tred);
        $board->save();

        return redirect()->route('board', [$tred->id]);

    }

    public function boardAnswer(Tred $tred, Board $board)
    {
        return view('quote', [
            'boardId' => $board->id,
            'tredId' => $tred->id
        ]);
    }

    public function deleteBoard(Tred $tred, Board $board)
    {
        $board->delete();

        return redirect()->route('board', [$tred->id]);
    }

    public function forceDeleteBoard(Tred $tred, Board $board)
    {
        $board->forceDelete();

        return redirect()->route('admin-board', [$tred->id]);
    }

    public function restoreBoard($board)
    {
        Board::withTrashed()->find($board)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
