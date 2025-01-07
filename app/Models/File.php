<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'mime_type',
        'path',
        'size',
        'slug'
    ];

    public function castToHumanReadableSize(): string
    {
        $bytes = $this->size;
        $units = ['B', 'KB', 'MB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
