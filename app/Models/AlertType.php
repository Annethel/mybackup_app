<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 

class AlertType extends Model
{
   protected $fillable = [
        'name',
    ];
     public function alerts()
    {
        return $this->hasMany(Alert::class, 'alert_type_id');
    }

}
