<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'issuer',
        'issued_at',
        'expires_at',
        'credential_id',
        'credential_url',
    ];

    protected $casts = [
        'issued_at'  => 'date',
        'expires_at' => 'date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
