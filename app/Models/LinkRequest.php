<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'guardian_id',
        'code',
        'status',
        'generated_at'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }
}
