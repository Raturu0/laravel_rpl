<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'commentsss';
    protected $fillable = [
        'title',
        'body',
        'event_id',
        'timestamp',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

}
