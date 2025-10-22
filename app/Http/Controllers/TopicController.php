<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\TopicsRequest; 

class TopicController extends Controller
{

    public function index()
    {
        return view('content.topics.index');
    }

    public function create()
    {
        return view('content.topics.create');
    }

    public function store(TopicsRequest $request)
    {
        Topic::create($request->validated());

        return redirect()->route('topics.index')->with('success', 'Topik berhasil ditambahkan');
    }

    public function edit(Topic $topic)
    {
        return view('content.topics.edit', compact('topic'));
    }

  
    public function update(TopicsRequest $request, Topic $topic)
    {
        $topic->update($request->validated());

        return redirect()->route('topics.index')->with('success', 'Topik berhasil diperbarui');
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topik berhasil dihapus');
    }
}