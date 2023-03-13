<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Interview;
use App\Models\QuestionAnswered;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index')->with('users', $users);
    }

    /**
     * Display a listing of the candidates.
     *
     * @return \Illuminate\Http\Response
     */
    public function candidates()
    {
        if (auth()->check() and auth()->user()->roles->pluck('name')->contains('Admin')) {
            $users = User::where('password', '=', null)->get();
        } else {
            $users = User::where('password', '=', null)->where('company_id', '=',  auth()->user()->company_id)->get();
        }
        return view('admin.users.candidates')->with('users', $users);
    }

    /**
     * Display dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (auth()->check() and auth()->user()->roles->pluck('name')->contains('Admin')) {
            $users = User::all();
            $companies = Company::all();
            $interviews = Interview::all();
            $answers = QuestionAnswered::all();

            //cantidades
            $count_u = count($users);
            $count_c = count($companies);
            $count_i = count($interviews);
            $count_a = count($answers);
            $data = [
                'users' => $count_u,
                'companies' => $count_c,
                'interviews' => $count_i,
                'answers' => $count_a
            ];
        } else {
            $users = User::where('company_id', '=',  auth()->user()->company_id)->get();
            $interviews = Interview::where('company_id', '=',  auth()->user()->company_id)->get();
            $candidates = User::where('password', '=', null)->where('company_id', '=',  auth()->user()->company_id)->get();

             //cantidades
             $count_u = count($users);
             $count_c = count($candidates);
             $count_i = count($interviews);
             $count_a = 12;
             $data = [
                 'users' => $count_u,
                 'candidates' => $count_c,
                 'interviews' => $count_i,
                 'answers' => $count_a
             ];
        }
        return view('admin.dashboard')->with($data);
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
}
