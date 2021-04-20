<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Major;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::with('students')->with('major')->paginate(5);
        $classesTemp =[];
        foreach ($classes as $class ) {
             $class->studentsTotal = $class->students->count();
        }
        return Inertia::render('Class/index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::all();
        return Inertia::render('Class/create',compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'level'=>'required',
            'major'=>'required',
            'label'=>'required|numeric',
        ]);
        $classModel = new Classes;
        $classModel->createClass($request);
        return redirect()->route('classes.index')->with('successMesage','Class was succcessfuly added ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $classes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classes = Classes::find($id);
        $majors = Major::all();
        return Inertia::render('Class/edit',compact('majors','classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $class = Classes::find($id);
        $classModel = new Classes;
        $classModel->updateClass($request,$class);
        return redirect()->back()->with('successMesage','Class was Successfuly Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $className = explode(' ',request()->className);
            $class = Classes::where('level',strtolower($className[0]))
            ->where('label',$className[2])
            ->whereHas('major',function($q)use ($className){
                $q->where('label',ucfirst($className[1]));
            })
                ->first();
                $classes = Classes::find($id);

        if ($classes->id !== $class->id) {
            return redirect()->back()->swithInput()->withErrors(['ClassName'=>'Class name you entered is wrong']);
        }
        $class->delete();
        return redirect()->back()->with('successMesage','Class was Successfuly Deleted');
    }
    // custom
    public function where()
    { 
        $keyword = request()->search;
        $className = explode(' ',$keyword);
        $word = str_replace(' ',' ',ucwords($keyword));

        $result = Classes::where(function($query)use ($className,$keyword){
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
        foreach ($result as $class ) {
            $class->studentsTotal = $class->students->count();
       }
        return $result;
    }
}
