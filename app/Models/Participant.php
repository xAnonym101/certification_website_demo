<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;

    protected $primaryKey = 'participant_id';

    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address'
    ];

    public function courses()
    {
        return $this->belongsToMany(
            Course::class, 
            'course_participants',
            'participant_id',
            'course_id'
        )->withPivot('registration_date', 'participant_course_id');
    }
}
