<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'name',
        'role',
        'start_date',
        'end_date',
        'url',
        'description',
        'technologies',
        'order_index',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'order_index'=> 'integer',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
