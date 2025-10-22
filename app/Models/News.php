<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User; 
use App\Models\Topic;
use Illuminate\Support\Facades\Auth; 
use Laravolt\Suitable\AutoSort;
use Illuminate\Database\Eloquent\SoftDeletes;


class News extends Model
{
    use HasFactory, AutoSort, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'published_at',
        'author_id',
        'image',
        'views_count',
        'topic_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
    public function topic()
{
    return $this->belongsTo(Topic::class);
}

protected static function booted()
    {
        static::created(function ($news) {
            
            $user = Auth::user(); 

            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'   => $user->id,
                    'action'    => 'Membuat berita: ' . $news->title,
                    'model_type'=> self::class,
                    'model_id'  => $news->id,
                ]);
            }
        });
        static::updated(function ($news) {
            $user = Auth::user();
            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'    => $user->id,
                    'action'     => 'Mengedit berita: ' . $news->title,
                    'model_type' => self::class,
                    'model_id'   => $news->id,
                ]);
            }
        });

        static::deleted(function ($news) {
            $user = Auth::user();
            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'    => $user->id,
                    'action'     => 'Menghapus berita: ' . $news->title,
                    'model_type' => self::class,
                    'model_id'   => $news->id,
                ]);
            }
        });
    }
}