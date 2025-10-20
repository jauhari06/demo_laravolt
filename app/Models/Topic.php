<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use Laravolt\Suitable\AutoSort; 

class Topic extends Model
{
    use HasFactory, AutoSort;

    protected $fillable = ['name', 'slug'];

    public function news()
    {
        return $this->hasMany(News::class);
    }

    /**
     * Boot model dan tambahkan listener untuk aktivitas.
     */
    protected static function booted()
    {
        static::created(function ($topic) {
            /** @var \App\Models\User|null $user */
            $user = Auth::user(); // Gunakan Auth::user() untuk mendapatkan user yang terautentikasi

            
            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'   => $user->id,
                    'action'    => 'Membuat topik: ' . $topic->name,
                    'model_type'=> self::class,
                    'model_id'  => $topic->id,
                ]);
            }
        });
        static::updated(function ($topic) {
            $user = Auth::user();
            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'    => $user->id,
                    'action'     => 'Mengedit topik: ' . $topic->name,
                    'model_type' => self::class,
                    'model_id'   => $topic->id,
                ]);
            }
        });

        static::deleted(function ($topic) {
            $user = Auth::user();
            if ($user) {
                \App\Models\ActivityLog::create([
                    'user_id'    => $user->id,
                    'action'     => 'Menghapus topik: ' . $topic->name,
                    'model_type' => self::class,
                    'model_id'   => $topic->id,
                ]);
            }
        });
    }
}