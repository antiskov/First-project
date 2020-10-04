<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreThread;
use App\Topic;
use App\Thread;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class ThreadController
 * @package App\Http\Controllers
 */
class ThreadController extends Controller
{
    /**
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function getAll(Topic $topic)
    {
<<<<<<< HEAD
=======

>>>>>>> 88a7668... done
        return view('thread', [
            'threads' => $topic->load('threads')->threads,
            'topicId' => $topic->id
        ]);
    }
    /**
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function setNew(Topic $topic)
    {
        return view('set_thread', ['topicId' => $topic->id]);
    }

    /**
     * @param Topic $topic
     * @param StoreThread $request
     * @return RedirectResponse
     */
    public function set(Topic $topic, StoreThread $request)
    {
        $thread = new Thread($request->all());
        $thread->user()->associate(auth()->user());
        $thread->topic()->associate($topic);
        $thread->save();

        return redirect()->route('threads', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $thread
     * @return RedirectResponse
     */
    public function delete(Topic $topic, Thread $thread)
    {
        $thread->delete();

        return redirect()->route('threads', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $thread
     * @return RedirectResponse
     */
    public function deleteForAdmin(Topic $topic, Thread $thread)
    {
        $thread->delete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @param Thread $thread
     * @return RedirectResponse
     */
    public function forceDelete(Topic $topic, Thread $thread)
    {
        $thread->forceDelete();

        return redirect()->route('admin-treds', [$topic->id]);
    }

    /**
     * @param Topic $topic
     * @return Application|Factory|View
     */
    public function getAllForAdmin(Topic $topic)
    {
        return view('admin.admin_threads', [
            'threads' => $topic->load('threads')->threads,
            'topicId' => $topic->id
        ]);
    }

    /**
     * @param $thread
     * @return RedirectResponse
     */
    public function restore($thread)
    {
        Thread::withTrashed()->find($thread)->restore();

        return redirect()->route('soft-deleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'threads' => Thread::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
