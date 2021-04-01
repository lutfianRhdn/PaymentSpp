<?php

namespace App\Models;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function officer()
    {
        return $this->belongsTo(Guard::class,'guard_id');
    }
    public function tuition()
    {
        return $this->belongsTo(Tuition::class);
    }
    public function createPayment($data)
    {
        $now = Carbon::now();
        $tuition= Tuition::where('year',$now->format('Y'))->first();
        if ($tuition === null) {
            return false;
        }
        $path = $data->file('photo')->store('public/payment-proof');
        try {
            foreach (  $data->month as $month) {
                $month +=1;
                Payment::create([
                    'student_id'=>$data->student,
                    'guard_id'=>auth()->user()->officer->id,
                    'tuition_id'=>$tuition->id,
                    'month'=> DateTime::createFromFormat('m',$month)->format('F'),
                    'year'=>$now->format('Y'),
                    'nominal'=>$tuition->nominal,
                    'photo_path'=>substr($path,7)
                ]); 
            }

        } catch (\Throwable $th) {
            $path->delete();
        }
        
    return true;
    }
}
