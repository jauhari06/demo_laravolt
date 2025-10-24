<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\TopicsRequest; 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TopicController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Topic::class);
        return view('content.topics.index');
    }

    public function create()
    {
        $this->authorize('create', Topic::class);
        return view('content.topics.create');
    }

    public function store(TopicsRequest $request)
    {
        $this->authorize('create', Topic::class);
        Topic::create($request->validated());

        return redirect()->route('topics.index')->with('success', 'Topik berhasil ditambahkan');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('content.topics.edit', compact('topic'));
    }

  
    public function update(TopicsRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->validated());

        return redirect()->route('topics.index')->with('success', 'Topik berhasil diperbarui');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('success', 'Topik berhasil dihapus');
    }
}