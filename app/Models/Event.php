<?php

namespace App\Models;

// iluminate menyimpan function2

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'timestamp'
    ];
    protected $table = 'events';
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}