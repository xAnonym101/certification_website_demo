<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Participant;

class Course extends Model
{
    use HasFactory;

    protected $primaryKey = 'course_id';

    protected $fillable = [
        'course_name',
        'course_description',
        'instructor_name',
        'start_date',
        'end_date'
    ];

    public function participants()
    {
        return $this->belongsToMany(
            Participant::class, 
            'course_participants', 
            'course_id', 
            'participant_id'
        )->withPivot('registration_date', 'course_participant_id');
    }
}
