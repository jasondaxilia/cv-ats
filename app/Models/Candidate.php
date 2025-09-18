<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'country',
        'region',
        'city',
        'address_line',
        'summary',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /** ===== Relasi Utama ===== */
    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    /** ===== Detail Ekstraksi ===== */
    public function experiences()
    {
        return $this->hasMany(Experience::class)->orderBy('start_date', 'desc');
    }

    public function educations()
    {
        return $this->hasMany(Education::class)->orderBy('end_year', 'desc')->orderBy('start_year', 'desc');
    }

    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class)->orderBy('order_index');
    }

    public function publications()
    {
        return $this->hasMany(Publication::class);
    }

    public function awards()
    {
        return $this->hasMany(Award::class);
    }

    public function skills()
    {
        return $this->hasMany(CandidateSkill::class)->orderBy('name');
    }

    public function languages()
    {
        return $this->hasMany(CandidateLanguage::class);
    }

    public function links()
    {
        return $this->hasMany(CandidateLink::class);
    }
}
