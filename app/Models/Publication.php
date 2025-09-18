<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'title',
        'publisher',
        'published_at',
        'url',
        'description',
    ];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
