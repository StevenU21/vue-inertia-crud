<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }
}
