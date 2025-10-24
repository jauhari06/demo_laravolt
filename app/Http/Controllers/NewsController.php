<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {

        $this->authorize('viewAny', News::class);

        return view('content.news.index');
    }

    public function create()
    {
        $this->authorize('create', News::class);

        return view('content.news.create');
    }

    public function store(NewsRequest $request)
    {
        $this->authorize('create', News::class);

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
        $this->authorize('update', $news);

        $news->load('topic');
        return view('content.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news)
{
    $this->authorize('update', $news);

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
        $this->authorize('delete', $news);

        $news->delete();

        return redirect()
            ->route('news.index')
            ->withSuccess('Berita berhasil dihapus.');
    }

    public function flag($id)
{
    $news = News::findOrFail($id);
    $this->authorize('flag', $news);

    $news->update(['is_flagged' => true]);

    return redirect()
        ->route('news.index')
        ->withSuccess('Berita berhasil ditandai.');
}

public function unflag($id)
{
    $news = News::findOrFail($id);
    $this->authorize('flag', $news);

    $news->update(['is_flagged' => false]);

    return redirect()
        ->route('news.index')
        ->withSuccess('Tanda pada berita telah dihapus.');
}

public function approve(News $news): RedirectResponse
{
    $this->authorize('approve', $news);

    if ($news->is_flagged) {
        return redirect()
            ->route('news.index')
            ->withErrors('Berita yang ditandai (flagged) tidak dapat dipublikasikan. Lepas tanda terlebih dahulu.');
    }

    $news->update([
        'status' => 'published',
        'approved_by' => Auth::id(),
        'approved_at' => now(),
    ]);

    return redirect()
        ->route('news.index')
        ->withSuccess('Berita berhasil dipublikasikan.');
}

}