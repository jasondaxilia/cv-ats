<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'type',
        'url',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
