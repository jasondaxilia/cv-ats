<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'original_filename',
        'file_path',
        'file_size',
        'file_mime',
        'language',
        'pages_count',
        'text_content',
        'parsed_json',
        'parse_status',
        'parsed_at',
        'failed_reason',
        'parser_version',
        'validation_status',
        'validated_at',
    ];

    protected $casts = [
        'file_size'        => 'integer',
        'pages_count'      => 'integer',
        'parsed_json'      => 'array',
        'parsed_at'        => 'datetime',
        'validated_at'     => 'datetime',
    ];

    /** Kandidat pemilik CV */
    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    /** Riwayat tahap/pipeline */
    public function stages()
    {
        return $this->hasMany(ResumeStageHistory::class)->latest('id');
    }

    /** ----- (Opsional) Scope bantu ----- */
    public function scopeParsed($query)
    {
        return $query->where('parse_status', 'success');
    }

    public function scopeValidated($query)
    {
        return $query->where('validation_status', 'validated');
    }
}
