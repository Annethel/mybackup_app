<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'name',
        'phone',
        'type',
        'relationship',
        'address'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}

