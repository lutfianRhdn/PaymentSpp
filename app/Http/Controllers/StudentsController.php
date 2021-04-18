<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Payment;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
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
        $userModel =new User;
        $userModel->createStudent($request);
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
        $student = Student::with('user')->with('class',function($q){$q->with('major');})->with('payments')->find($student->id);
        
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
        $student->user()->delete();
        return redirect()->back()->with('successMesage','Student was Successfuly Deleted');
    }

    public function where()
    {
        $keyword = request('search');
        $student = Student::where(function($query) use ($keyword){
            $query->whereHas('user',function($q)use ($keyword){$q->where('name','LIKE',"%{$keyword}%");});
            $query->orWhere('nisn','LIKE',"%{$keyword}%");
            $query->orWhere('nis','LIKE',"%{$keyword}%");
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
                
            }
        })
        ->with('user')->with('class',function($q){$q->with('major');})->paginate(100);
        return $student;
    }
    public function calculate($student)
    {
        
        $months =[];
        $payments = $student->payments()->orderBy('year','ASC')->get() ;
        foreach ($payments as $payment ) {
            $month = Carbon::parse("{$payment->month}-{$payment->year}")->format('m-Y');
            array_push($months,$month);
        }
        $now = Carbon::now();
        $yearMax = Carbon::createFromFormat('m-Y',count($months) == 0 ? $student->created_at->format('m-Y') : max($months))->format('Y');
        $monthMax  = (int)Carbon::createFromFormat('m-Y',count($months) == 0 ? $student->created_at->format('m-Y') : max($months) )->format('m');
        $test = [];
        for($i = $yearMax;$i <= $now->format('Y');$i++){
            for ($j=1; $j <= 12; $j++) {
                $month =Carbon::createFromFormat('m-Y',"{$j}-{$i}");
                $data = $student->payments()->where('year',$i)->where('month',$month->format('F'))->get();
                if($data->count() == 0){
                    array_push($test,$monthMax);
                    $monthMax +=1;
                }
            }
        }
        $arrears = $monthMax;
        dd($test);
        dd($arrears,$yearMax,max($months));
    }
}
