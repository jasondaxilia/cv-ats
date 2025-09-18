<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'institution',
        'degree',
        'major',
        'gpa',
        'start_year',
        'end_year',
        'location',
        'description',
        'order_index',
    ];

    protected $casts = [
        'start_year' => 'integer',
        'end_year'   => 'integer',
        'order_index'=> 'integer',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
