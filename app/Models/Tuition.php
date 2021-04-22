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
        $now = Carbon::now();
        $tuition = Tuition::where('year',$now->format('Y'))->first();
        $year = $now->format('Y');
        if ($tuition !== null) {
            $this->year = Carbon::now()->format('Y')+1;
            $year =$this->year; 
        }
        return Tuition::create([
            'nominal'=>$data->nominal,
            'year'=>$year
        ]);
        
    }
    public function updateTuition($data,$tuition)
    {
        return $tuition->update([
            'nominal'=>$data->nominal,
            'year'=>Carbon::now()->format('Y')+1
        ]);
        
    }
    public function search($keyword)
    {
        return Tuition::where(function($query)use($keyword){
            $query->where('year','LIKE',"%{$keyword}%");
            $query->orWhere('nominal','LIKE',"%{$keyword}%");
        })->with('payments')->paginate(100);
    }
}
