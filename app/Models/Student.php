<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }
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
        $word = str_replace(' ',' ',ucwords($keyword));

        return Student::where(function($query) use ($keyword,$word){
            // where name, nisn,nis
            $query->whereHas('user',function($q)use ($keyword){$q->where('name','LIKE',"%{$keyword}%");});
            $query->orWhere('nisn','LIKE',"%{$keyword}%");
            $query->orWhere('nis','LIKE',"%{$keyword}%");
            // where class Name with label and level example searching xi ak 2
            $className = explode(' ',$keyword);
            if (count($className) >0) {
                $query->orWhereHas('class',function($q)use ($className){
                    $q->where('level',strtolower($className[0]));
                    if (count($className) > 1) {
                        $q->WhereHas('major',function($q)use ($className){
                            $q->where('label',ucfirst($className[1]));
                        });
                    }
                    if (count($className) >2) {
                        $q->Where('label',$className[2]);
                    }
                   
                });
            // where class Name without label and level example searching ak  or analis kimia

                $data = $query->orWhereHas('class',function($q)use($word){
                    $q->WhereHas('major',function($q)use ($word){
                        $q->where('label',$word);        
                    });
                }) ;
                if ($data->count() ==0) {
                    $query->orWhereHas('class',function($q)use($word){
                        $q->WhereHas('major',function($q)use ($word){
                            $q->where('name','LIKE',"%{$word}%");
                        });
                    }) ;
                }
                
            }
        })
        
        ->with('user')->with('class',function($q){$q->with('major');})->paginate(100);
    }
}
