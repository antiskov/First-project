<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Requests\StoreContent;
use App\Topic;
use App\Tred;

class TopicController extends Controller
{
    public function allTopics()
    {
        return view('welcome', ['data' => Topic::all()]);
    }

    public function newTopic()
    {
        return view('content.topic');
    }

    public function addTopic(StoreContent $request)
    {
        $topic = new Topic($request->all());
        $topic->user()->associate(auth()->user());
        $topic->save();


        return redirect()->route('topics');
    }

    public function deleteTopic($topic)
    {
        Topic::destroy($topic);
        //Tred::destroy($topic->treds);

        return redirect()->route('topics');
    }

    public function deleteTopicForAdmin($topic)
    {
        Topic::destroy($topic);

        return redirect()->route('admin-panel');
    }

    public function forceDeleteTopic(Topic $topic)
    {
        $topic->forceDelete();

        return redirect()->route('admin-panel');
    }

    public function restoreTopic($topic)
    {
        Topic::withTrashed()->find($topic)->restore();

        return view('admin.admin_softdeleted', [
            'topics' => Topic::onlyTrashed()->get(),
            'treds' => Tred::onlyTrashed()->get(),
            'boards' => Board::onlyTrashed()->get()
        ]);
    }
}
