<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Http\Resources\NewsResource;
use App\Http\Requests\Api\StoreNewsRequest;
use App\Http\Requests\Api\UpdateNewsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query()->with(['topic', 'author']);
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('topic_id')) {
            $query->where('topic_id', $request->topic_id);
        }
        // $query->where('status', 'Published');

        $news = $query->autoSort()->paginate(10);

        return NewsResource::collection($news);
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5);
        $data['author_id'] = Auth::id() ?? 1;
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news = News::create($data);

        return new NewsResource($news->load(['topic', 'author']));
    }

    public function show(News $news)
    {
        $news->increment('views_count');

        return new NewsResource($news->load(['topic', 'author']));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $data = $request->validated();

        if ($request->has('title')) {
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);
        return new NewsResource($news->load(['topic', 'author']));
    }

    public function destroy(News $news)
    {
        $news->delete();
        return response()->json(['message' => 'News deleted successfully']);
    }
}