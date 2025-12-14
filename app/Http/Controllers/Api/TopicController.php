<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use App\Http\Resources\TopicResource;
use App\Http\Requests\Api\StoreTopicsRequest;
use App\Http\Requests\Api\UpdateTopicsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravolt\Epicentrum\Contracts\Requests\Account\Update;

class TopicController extends Controller
{
    public function index()
    {
        $topics = Topic::query()
            ->autoSort()
            ->paginate(10);

        return TopicResource::collection($topics);
    }

    public function store(StoreTopicsRequest $request)
    {
        $data = $request->validated();
        
        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);
        $data['author_id'] = Auth::id() ?? 1;

        $topic = Topic::create($data);

        return new TopicResource($topic);
    }

    public function update(UpdateTopicsRequest $request)
    {
        $data = $request->validated();
        
        if ($request->has('name')) {
            $data['slug'] = Str::slug($request->name) . '-' . Str::random(5);
        }

        $topic = Topic::update($data);

        return new TopicResource($topic);
    }

    public function show(Topic $topic)
    {
        return new TopicResource($topic);
    }
}