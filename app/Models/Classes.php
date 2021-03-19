<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;
    protected $tables = 'classes';
    protected $guarded = [];
    
    public function students()
    {
        return $this->hasMany(Student::class,'class_id');
    }
    public function major()
    {
        return $this->belongsTo(Major::class);
    }
}
