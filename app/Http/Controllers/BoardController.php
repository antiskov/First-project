<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;
use App\Board;
use User;

class BoardController extends Controller
{
    public function board(Tred $tred)
    {
        return view('board', [
            'boards' => $tred->load('boards')->boards,
            'tred' => $tred,
        ]);
    }

    public function addBoard(Tred $tred, Request $request)
    {
        $board = new Board($request->all());
        $board->user()->associate(auth()->user());
        $board->treds()->associate($tred);
        $board->save();

        return redirect()->route('board', [$tred->id]);

    }

    public function addBoardQuote(Tred $tred, Board $board, Request $request)
    {
        $this_board = new Board($request->all());
        $this_board->board_quote =$board->board_item;
        $this_board->user()->associate(auth()->user());
        $this_board->treds()->associate($tred);
        $this_board->save();

        return redirect()->route('board', [$tred->id]);
    }

    public function boardQuote(Tred $tred, Board $board)
    {

        return view('quote', [
            'boardId' => $board->id,
            'tredId' => $tred->id
        ]);
    }

    public function deleteBoard(Tred $tred, Board $board)
    {
        $board->delete();
        return  redirect()->route('board', [$tred->id]);
    }
}
