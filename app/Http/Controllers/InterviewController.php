<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\Question;
use App\Models\QuestionAnswered;
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
        if (auth()->check() and auth()->user()->roles->pluck('name')->contains('Admin')) {
            $interviews = Interview::all();
        } else {
            $interviews = Interview::where('company_id', '=', $user->company_id)->get();
        }
        return view('admin.interview.index')->with('interviews', $interviews);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function candidancie(User $user, Interview $interview)
    {
        $userAuth = auth()->user();
        $company_id = $userAuth->company_id;
        $answereds = QuestionAnswered::select('question_answereds.*')
            ->join('questions', 'questions.id', '=', 'question_answereds.question_id')
            ->where('questions.interview_id', $interview->id)
            ->where('question_answereds.user_id', $user->id)
            ->get();
        $data = [
            'answereds' => $answereds,
            'user' => $user,
        ];
        return view('admin.interview.candidancies')->with($data);
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
            'description' => 'required|max:1500',
            'goodbye' => 'required|max:100|min:10',
            'time_to_think' => 'required',
            'time_to_reply' => 'required',
        ]);

        $user = User::find(auth()->user()->id);
        //var_dump($request);
        if (isset($user->company->id) && auth()->user()->company_id == $user->company_id) {
            $new_interview = Interview::create([
                'position' => $request->position,
                'description' => $request->description,
                'time_to_think' => $request->time_to_think,
                'time_to_reply' => $request->time_to_reply,
                'goodbye' => $request->goodbye,
                'user_id'  => $user->id,
                'company_id'  => $user->company->id,
            ]);

            #por cada input que viene de la plantilla se crea una pregunta con el id de la entrevista creada
            for ($i = 0; $i < 5; $i++) {
                Question::create([
                    'question' => $request->question[$i],
                    'interview_id' => $new_interview->id,
                    'video' => $request->video[$i],
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
        return view('admin.interview.show')->with('interview', $interview);
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
            'domicile' => 'required|max:100',
            'phone' => 'required|max:50',
            'date_of_birth' => 'required|date|before:01/01/2010'
        ]);
        $user = User::where('email', '=', $request->email)->first();
        if (isset($user)) {
            if (($user->company_id == $interview->company_id)) {
                $error = 'Ya te encuentras en un proceso de selección en esta empresa, o eres reclutador de la misma.';
                $data = [
                    'interview' => $interview,
                    'error' => $error
                ];
                return view('candidate.apply')->with($data);
            } else {
                $user_update = $request->only(['domicile', 'phone', 'domicile']);
                $user_update['company_id'] = $interview->company_id;
                $user->update($user_update);
            }
        } else {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'domicile' => $request->domicile,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'company_id' => $interview->company_id,
                'email' => $request->email,
            ])->assignRole('Candidate');
        }
        $question = Question::where('interview_id', '=', $interview->id)->first();
        $data = [
            'question' => $question,
            'user' => $user
        ];
        return view('candidate.question')->with($data);
    }

    /**
     * Save the answer and go to the next question for candidate.
     *
     * @param  \App\Models\Question  question
     * @return \Illuminate\Http\Response
     */
    public function next_question(Request $request)
    {
        $question_now = Question::find($request->question_id);
        $interview = Interview::find($question_now->interview_id);
        $user = User::find($request->user_id);

        if ($question_now->video == 0) {
            QuestionAnswered::create([
                'question_id' => $question_now->id,
                'user_id' => $user->id,
                'answer' => $request->answer
            ]);
        } else {
            QuestionAnswered::create([
                'question_id' => $question_now->id,
                'user_id' => $user->id,
                'answer' => $request->answer . '.webm'
            ]);
        }

        //variable to know what question is the last one
        $question = Question::find($question_now->id + 1);
        $ultimo = $interview->question->last();

        $last = null;
        if ($ultimo['id'] == $question->id) {
            $last = 1;
        }

        $question = Question::find($request->question_id + 1);


        $data = [
            'question' => $question,
            'user' => $user,
            'last' => $last
        ];

        return view('candidate.question')->with($data);
    }

    public function last_question(Request $request)
    {
        $question_now = Question::find($request->question_id);
        $interview = Interview::find($question_now->interview_id);
        $user = User::find($request->user_id);

        if ($question_now->video == 0) {
            QuestionAnswered::create([
                'question_id' => $question_now->id,
                'user_id' => $user->id,
                'answer' => $request->answer
            ]);
        } else {
            QuestionAnswered::create([
                'question_id' => $question_now->id,
                'user_id' => $user->id,
                'answer' => $request->answer . '.webm'
            ]);
        }

        return redirect()->route('aplicar.final', $interview);
    }

    /**
     * Apply for candidate.
     *
     * @param  \App\Models\Interview  $interview
     * @return \Illuminate\Http\Response
     */
    public function goodbye(Interview $interview)
    {
        return view('candidate.goodbye')->with('interview', $interview);
    }

    public function save_video(Request $request)
    {
        //var_dump($_FILES['blobFile']);
        if (move_uploaded_file($_FILES['blobFile']['tmp_name'],  'video/answer/' . $request->time . '.webm')) {
            return response()->json(['status' => 'ok']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }
}
