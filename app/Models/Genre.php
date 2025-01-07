<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Genre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($genre) {
            $genre->slug = Str::slug($genre->name);
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }
}
