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
    public function createClass($data)
    {
        return Classes::create([
            'level'=>$data->level,
            'major_id'=>$data->major,
            'label'=>$data->label
        ]);
    }
    public function updateClass($data,$class)
    {
        return $class->update([
            'level'=>$data->level,
            'major_id'=>$data->major,
            'label'=>$data->label
        ]);
    }
    public function search($keyword)
    {
        $className = explode(' ',$keyword);
        $word = str_replace(' ',' ',ucwords($keyword));

        return Classes::where(function($query)use ($className,$keyword){
            if (count($className) >0) {
                    $level = $query->where('level',strtolower($className[0]));
                    if (count($className) > 1) {
                       
                       $major = $query->WhereHas('major',function($q)use ($className){
                            $q->where('label',ucfirst($className[1]));
                        });
                    }

                    if (count($className) >2) {
                        $query->Where('label',$className[2]);
                    }
                
            }
        })
        ->orWhere(function($query)use ($word){
            $where = explode(' ',$word);
            if (count($where) >1) {
            $query->whereHas('major',function($q)use($where){
                $q->where('label','LIKE',"%{$where[0]}%");
            });
            $query->where('label',$where[1]);
        }
        })
        ->orWhereHas('major',function($q)use ($word){
            $q->where('label','LIKE',"%{$word}%");        
        })
        ->orWhereHas('major',function($q)use ($word){
            $q->where('name','LIKE',"%{$word}%");
        })
      
        ->with('major')
        ->paginate(100);
      
    }

}
