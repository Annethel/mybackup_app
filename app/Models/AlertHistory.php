<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlertHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'latitude',
        'longitude',
        'location_name',
        'recorded_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

