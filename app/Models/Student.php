<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'institution', 'share_location', 'auto_alert_on_missed_calls'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class, 'student_id');
    }

    public function alertHistories()
    {
        return $this->hasMany(AlertHistory::class, 'student_id');
    }

    public function emergencyContacts()
    {
        return $this->hasMany(EmergencyContact::class, 'student_id');
    }

    public function linkRequests()
    {
        return $this->hasMany(LinkRequest::class, 'student_id');
    }
}

