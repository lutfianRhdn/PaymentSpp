<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use App\Models\Payment;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

    public function index()
    {
        $now = Carbon::now();
        $paymentOfTheMonth = Payment::where('month',$now->format('F'))->whereYear('year',$now->format('Y'))->count();
        $payments = $this->getTotal($this->filterData(Payment::whereYear('year',$now->format('Y')))->groupBy('month'));
        $paymentOfTheYear = $payments['paymentOfTheYear'];
        $totalPayments = $payments['totalPayments'];
        $totalStudent = Student::all()->count();
        $totalOfficer = Guard::all()->count();
        $months = $this->months;
        $payments = Payment::limit(5)->with('student',function($q){$q->with('user');})->orderBy('id','DESC')->get();
        return Inertia::render('Dashboard',compact('paymentOfTheMonth','paymentOfTheYear','totalStudent','totalOfficer','totalPayments','months','payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    // custom
    public function getTotal($data)
    {
        $paymentOfTheYear =0;
        $totalPayments = [];
        foreach ($data as $payment) {
            $nominal =0;
            // $paymentCount
            foreach ($payment as $index =>$pay ) {
                    $nominal += $pay->nominal;
                    if ($index+1 == $payment->count()) {
                        array_push($totalPayments,collect(['month'=>$pay->month,'nominal'=>$nominal]));
                    }
                    $paymentOfTheYear +=$pay->nominal;
                    

            }
        }
        return collect(compact('paymentOfTheYear','totalPayments'));
    }
    public function filterData($data)
    {
        if (auth()->user()->hasRole('admin')) {
            return $data->get();
        }
        if (auth()->user()->hasRole('guard')) {
            return $data->where('guard_id',auth()->user()->officer->id)->get();
        }else{
            return $data->where('student_id',auth()->user()->student->id)->get();
        }

    }
}
