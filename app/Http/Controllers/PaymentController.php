<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Guard;
use App\Models\Payment;
use App\Models\Student;
use App\Models\Tuition;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    public function index()
    {
        $payments = Payment::with('tuition')
        ->with('student',function($q){
            $q->with('user');
        })->with('officer',function($q){
            $q->with('user');
        })->paginate(5);
    //   dd($payments[0]->officer);
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
    {
        //
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
            // dd($student);
            array_push($newStudents,collect(['value'=>$student->id,'name'=>$student->user->name]));
        }
        // dd(collect($newStudents));
        return collect($newStudents);
    }
}
