<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
