<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSkill extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'level',
        'years_of_experience',
        'last_used_year',
    ];

    protected $casts = [
        'years_of_experience' => 'float',
        'last_used_year'      => 'integer',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
