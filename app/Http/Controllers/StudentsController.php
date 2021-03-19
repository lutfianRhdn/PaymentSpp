<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('user')->with('class',function($q){$q->with('major');})->paginate(5);
        return Inertia::render('Students/index',compact('students')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('ok');
        $classes = Classes::with('major')->get();
        return Inertia::render('Students/create',compact('classes'));
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
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'nis' => 'required|unique:students',
            'nisn' => 'required|unique:students',
            'class' => 'required',
            'address'=>'required',
            'phone'=>'required'
        ]);
        // dd($request);
        $userModel =new User;
        $userModel->createStudent($request);
        // return true;
        return redirect()->route('students.index')->with('successMesage','Student was succcessfuly added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $student = Student::with('user')->with('class',function($q){$q->with('major');})->find($student->id);
        // dd($student);
        return Inertia::render('Students/show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        
        $student = Student::with('user')->with('class',function($q){$q->with('major');})->find($student->id);
        $classes = Classes::with('major')->get();

        return Inertia::render('Students/edit',compact('student','classes'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'nis' => 'required',
            'nisn' => 'required',
            'class' => 'required',
            'address'=>'required',
            'phone'=>'required'
        ]);
        $userModel = new User;
        $userModel->updateStudent($student,$request);
        return redirect()->back()->with('successMesage','Student was Successfuly Updated');

        // dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $this->validate(request(),[
            'nis'=>'required'
        ]);
        if ((int)request()->nis !== $student->nis) {
            return redirect()->back()->withInput()->withErrors(['nis'=>'nis you entered is wrong']);
        }
        // dd('mantap');
        $student->user()->delete();
        return redirect()->back()->with('successMesage','Student was Successfuly Deleted');
        // $student->user->delete();
    }
}
