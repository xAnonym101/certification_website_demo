<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Course;

class Participant extends Model
{
    // To create fake data
    use HasFactory;

    // The custom primary key
    protected $primaryKey = 'participant_id';

    // Columns of the data that are fillable
    protected $fillable = [
        'full_name',
        'email',
        'phone_number',
        'address'
    ];

    // Defines the function of many-many, must also have one in the Courses.php model
    public function courses()
    {
        return $this->belongsToMany(
            Course::class, 
            'course_participants',
            'participant_id',
            'course_id'
        )->withPivot('registration_date', 'course_participant_id');
    }
}
