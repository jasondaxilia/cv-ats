<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResumeStageHistory extends Model
{
    use HasFactory;

    protected $table = 'resume_stage_history';

    protected $fillable = [
        'resume_id',
        'stage',
        'note',
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
