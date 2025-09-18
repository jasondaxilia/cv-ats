<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'company',
        'title',
        'employment_type',
        'start_date',
        'end_date',
        'is_current',
        'location',
        'description',
        'achievements',
        'order_index',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_current' => 'boolean',
        'order_index'=> 'integer',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
