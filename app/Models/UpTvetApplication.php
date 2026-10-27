<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpTvetApplication extends Model
{
    use HasFactory;

    protected $table = 'up_tvet_applications';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'ic_number',
        'phone_number',
        'address',
        'city',
        'state',
        'postcode',
        'education_level',
        'school_name',
        'graduation_year',
        'course_interest',
        'why_choose_course',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_relationship',
        'father_name',
        'father_contact',
        'father_occupation',
        'mother_name',
        'mother_contact',
        'mother_occupation',
        'total_income',
        'invitation_officer_name',
        'invitation_officer_contact',
        'google_form_url',
        'status',
        'notes',
        'completed_at',
        'agreed_to_terms',
        'google_form_submitted_at',
        'google_form_response_id',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Semak sama ada semua medan utama borang permohonan telah diisi dengan lengkap
     */
    public function isComplete(): bool
    {
        return !empty($this->ic_number)
            && !empty($this->phone_number)
            && !empty($this->address)
            && !empty($this->city)
            && !empty($this->state)
            && !empty($this->course_interest);
    }
}
