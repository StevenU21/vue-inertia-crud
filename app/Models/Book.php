<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author',
        'release_date',
        'slug',
        'genre_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($book) {
            $book->slug = Str::slug($book->title);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
