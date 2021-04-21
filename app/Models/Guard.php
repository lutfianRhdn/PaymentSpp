<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guard extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function search($keyword)
    {
        return Guard::where(function($query) use ($keyword){
            $query->whereHas('user',function($q)use ($keyword){$q->where('name','LIKE',"%{$keyword}%");});
            $query->orWhereHas('user',function($q)use ($keyword){$q->where('email','LIKE',"%{$keyword}%");});
        })->with('user')->paginate(100); 
    }
}
