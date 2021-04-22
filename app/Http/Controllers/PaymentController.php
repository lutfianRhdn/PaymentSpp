<?php

namespace App\Http\Controllers;

use App\Exports\PaymentExport;
use App\Models\Classes;
use App\Models\Guard;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tuition;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:payment.index')->only('index');
        $this->middleware('permission:payment.create')->only('create');
        $this->middleware('permission:payment.update')->only('update');
        $this->middleware('permission:payment.delete')->only('destroy');
    }
    protected $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    public function index()
    {
        $data = Payment::with('tuition')
        ->with('student',function($q){
            $q->with('user');
        })->with('officer',function($q){
            $q->with('user');
        });
        $payments = $this->filterPayment($data)->paginate(5);
        return Inertia::render('Payments/index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $officers = Guard::with('user')->get();
        $classes = Classes::with('major')->get();
        $tuitions = Tuition::all();
        $months= $this->months;
        $newClasses =[];
        foreach ($classes as $class) {
            array_push($newClasses,collect(['value'=>$class->id,'name'=>"{$class->level} {$class->major->label} {$class->label}"]));
        }
        $classes = $newClasses;
        return Inertia::render('Payments/create',compact('officers','tuitions','classes','months'));
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
            'photo'=>'required|image|max:2046',
            'student'=>'required',
            'month'=>'required'
        ]); 
        $paymentModel = new Payment;
        $payment = $paymentModel->createPayment($request);
        if ($payment ==false) {
            return redirect()->back()->withErrors(['tuition'=>'this year the tuition ']);
        }
        return redirect()->route('payments.index')->with('SuccessMessage','Payment successfully addeed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {$data = Payment::with('tuition')
        ->with('student',function($q){
            $q->with('user');
        })->with('officer',function($q){
            $q->with('user');
        });
        $payments = $this->filterPayment($data)->where('student_id',$id)->paginate(5);
        return Inertia::render('Payments/show',compact('payments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // custom method
    public function getUser($id)
    {
        $students = Student::where('class_id',$id)->with('user')->get();
        $newStudents =[];
        foreach ($students as $student) {
            array_push($newStudents,collect(['value'=>$student->id,'name'=>$student->user->name]));
        }
        return collect($newStudents);
    }

    public function filterPayment($data)
    {
        
        $result= [];
        if (auth()->user()->hasRole('admin')) {
            $result = $data;
        }elseif (auth()->user()->hasRole('guard')) {
            $result = $data->where('guard_id',auth()->user()->officer->id);
        }else{
            $result = $data->where('student_id',auth()->user()->student->id);
        }
        return $result;
    }
    public function export()
    {
        return Excel::download(new PaymentExport(),'Payment.xlsx');
    }
    public function where()
    {
        $keyword = request()->search;
        $model  = new Payment;
        $data = $model->search($keyword);
        
        $payments = $this->filterPayment($data)->paginate(100);
        return $payments;
    }
}
