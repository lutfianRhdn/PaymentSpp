<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function createTuition($data,$year)
    {
        return Tuition::create([
            'nominal'=>$data->nominal,
            'year'=>Carbon::now()->format('Y')+1
        ]);
        
    }
    public function updateTuition($data,$tuition)
    {
        return $tuition->update([
            'nominal'=>$data->nominal,
            'year'=>Carbon::now()->format('Y')+1
        ]);
        
    }
}
