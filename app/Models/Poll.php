<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'question', 'options'];

    protected $casts = [
        'options' => 'array',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
