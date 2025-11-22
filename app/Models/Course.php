<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Participant;

class Course extends Model
{
    // To create fake data
    use HasFactory;

    // The custom primary key
    protected $primaryKey = 'course_id';

    // Columns of the data that are fillable
    protected $fillable = [
        'course_name',
        'course_description',
        'instructor_name',
        'start_date',
        'end_date'
    ];

    // Defines the function of many-many, must also have one in the Participant.php model
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
