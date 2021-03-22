<?php

namespace App\Http\Controllers;

use App\Models\Guard;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $guards = Guard::with('user')->paginate(5);
        return Inertia::render('Guards/index',compact('guards')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Guards/create',);
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
        ]);
        // dd($request);
        $userModel =new User;
        $userModel->createOfficer($request);
        // return true;
        return redirect()->route('guards.index')->with('successMesage','Officer was succcessfuly added ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function show(Guard $guard)
    {
        $guard = Guard::with('user')->find($guard->id);
        // dd($guard);
        return Inertia::render('Guards/show',compact('guard'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function edit(Guard $guard)
    {
        $guard = Guard::with('user')->find($guard->id);

        return Inertia::render('Guards/edit',compact('guard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guard $guard)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
        ]);
        $userModel = new User;
        $userModel->updateOfficer($guard,$request);
        return redirect()->back()->with('successMesage','Officer was Successfuly Updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guard  $guard
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guard $guard)
    {
        $this->validate(request(),[
            'email'=>'required'
        ]);
        // dd($guard,request());
        if (request()->email !== $guard->user->email) {
            return redirect()->back()->withInput()->withErrors(['email'=>'email you entered is wrong']);
        }
        $guard->user()->delete();
        return redirect()->back()->with('successMesage','Officer was Successfuly Deleted');
    }
}
