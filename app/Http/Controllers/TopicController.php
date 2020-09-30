<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreTopic;
use App\Topic;
use App\Thread;

/**
 * Class TopicController
 * @package App\Http\Controllers
 */
class TopicController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAll()
    {
        return view('welcome', ['data' => Topic::all()]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function setNew()
    {
        return view('content.topic');
    }

    /**
     * @param StoreTopic $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function set(StoreTopic $request)
    {
        $topic = new Topic($request->all());
        $topic->user()->associate(auth()->user());
        $topic->save();


        return redirect()->route('topics');
    }

    /**
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete($topic)
    {
        Topic::destroy($topic);

        return redirect()->route('topics');
    }

    /**
     * @param $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteForAdmin($topic)
    {
        Topic::destroy($topic);

        return redirect()->route('admin-panel');
    }

    /**
     * @param Topic $topic
     * @return \Illuminate\Http\RedirectResponse
     */
    public function forceDelete(Topic $topic)
    {
        $topic->forceDelete();

        return redirect()->route('admin-panel');
    }

    /**
     * @param $topic
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restoreTopic($topic)
    {
        Topic::withTrashed()->find($topic)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
