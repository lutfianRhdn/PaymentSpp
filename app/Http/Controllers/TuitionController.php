<?php

namespace App\Http\Controllers;

use App\Models\Tuition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TuitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $year;
    public function index()
    {
        $tuitions  = Tuition::with('payments')->paginate(5);
        foreach ($tuitions as $tuition ) {
             $tuition->totalPayment = $tuition->payments->count();
        }
        return Inertia::render('Tuitions/index',compact('tuitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $now = Carbon::now();
        $tuition = Tuition::where('year',$now->format('Y'))->first();
        $year = $now->format('Y');
        if ($tuition !== null) {
            $this->year = Carbon::now()->format('Y')+1;
            $year =$this->year; 
        }
        return Inertia::render('Tuitions/create',compact('year'));
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
            'nominal'=>'required|numeric',
            'year'=>'required'
        ]);
        $tuitionModel = new Tuition;
        $tuitionModel->createTuition($request,$this->year);
        return redirect()->route('tuitions.index')->with('successMesage','Tuition was succcessfuly added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function show(tuition $tuition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function edit(tuition $tuition)
    {
        return Inertia::render('Tuitions/edit',compact('tuition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tuition $tuition)
    {
        $request->validate([
            'nominal'=>'required|numeric',
            'year'=>'required'
        ]);
        $tuitionModel = new Tuition;
        $tuitionModel->updateTuition($request,$tuition);
        return redirect()->back()->with('successMesage','Tuition was succcessfuly added ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tuition  $tuition
     * @return \Illuminate\Http\Response
     */
    public function destroy(tuition $tuition)
    {
        $tuition->delete();
        return redirect()->back()->with('successMesage','Tuition was succcessfuly deleted ');
    }
}
