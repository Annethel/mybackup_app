<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'alert_type_id',
        'location_name',
        'latitude',
        'longitude',
        'type',
        'description',
        'sent_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

