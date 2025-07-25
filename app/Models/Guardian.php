<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 


class Guardian extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'relationship'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function linkRequests()
    {
        return $this->hasMany(LinkRequest::class, 'guardian_id');
    }

    
}
