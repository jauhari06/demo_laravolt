<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
 
        return view('content.news.index');
    }

    public function create()
    {
        return view('content.news.create');
    }

    public function store(NewsRequest $request)
    {
        $data = $request->validated();
        $data['author_id'] = Auth::id();


        if ($request->filled('_image')) {
            $images = json_decode($request->input('_image'), true);
            $data['image'] = $images[0]['file'] ?? null;
        }

        News::create($data);

        return redirect()
            ->route('news.index')
            ->withSuccess('Berita berhasil disimpan.');
    }

    public function edit(News $news)
    {

        $news->load('topic');
        return view('content.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
    {
        $data = $request->validated();


        if ($request->filled('_image')) {
            $images = json_decode($request->input('_image'), true);
            $data['image'] = $images[0]['file'] ?? $news->image;
        }

        $news->update($data);

        return redirect()
            ->route('news.index')
            ->withSuccess('Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        $news->delete();

        return redirect()
            ->route('news.index')
            ->withSuccess('Berita berhasil dihapus.');
    }
}
