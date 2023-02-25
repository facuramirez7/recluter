<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        if(auth()->check() and auth()->user()->roles->pluck('name')->contains('Admin')){
            $interviews = Interview::all();
        } else {
            $interviews = Interview::where('company_id', '=', $user->company_id)->get();
        }
        return view('admin.interview.index')->with('interviews', $interviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.interview.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //Validate the request
         $request->validate([
            'position' => 'required|max:50',
            'description' => 'required|max:1500'
        ]);

        $user = User::find(auth()->user()->id);
        //var_dump($request);
        if(isset($user->company->id) && auth()->user()->company_id == $user->company_id){
            $new_interview = Interview::create([
                            'position' => $request->position,
                            'description' => $request->description,
                            'user_id'  => $user->id,
                            'company_id'  => $user->company->id,
                         ]);

            #por cada input que viene de la plantilla se crea una pregunta con el id de la entrevista creada
            for($i = 0; $i < 5; $i++){
                if(!isset($request->video[$i])){
                    $video = 0;
                } else {
                    $video = 1;
                }
                Question::create([
                    'question' => $request->question[$i],
                    'interview_id' => $new_interview->id,
                    'video' => $video,
                ]);
            }
            return redirect()->route('entrevistas.index');            
        } else {
            return 'No se encontró el usuario';
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function show(Interview $interview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function edit(Interview $interview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interview $interview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interview $interview)
    {
        //
    }

    /**
     * Apply for candidate.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function apply(Interview $interview)
    {
        return view('candidate.apply')->with('interview', $interview);
    }

    public function store_user(Request $request)
    {
        $interview = Interview::find($request->interview_id);
        //Validate the request
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email',
            'surname' => 'required|max:50',
            'country' => 'required|max:50',
            'date_of_birth' => 'required|date|before:01/01/2010'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if(isset($user)){
            $user_update = $request->only(['name','surname','country']);
            $user_update['company_id'] = $interview->company_id;
            $user->update($user_update);
        } else{
            User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'country' => $request->country,
                'date_of_birth' => $request->date_of_birth,
                'company_id' => $interview->company_id,
                'email' => $request->email,      
            ])->assignRole('Candidate');
        }
        $question = Question::where('interview_id', '=', $interview->id)->first();
        return redirect()->route('aplicar_pregunta',$question);
    }

    /**
     * Apply question for candidate.
     *
     * @param  \App\Models\Question  question
     * @return \Illuminate\Http\Response
     */
    public function question(Question $question)
    {
        return view('candidate.question')->with('question', $question);
    }
}
