<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answers\UpdateAnswerRequest;
use App\Http\Requests\Questions\CreateAnswerRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Notifications\NewReplyAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateAnswerRequest $request, Question $question)
    {
        //
        $question->answers()->create(
            [
                'body' => $request->body,
                'user_id' => auth()->id()
            ]
        );

        $question->owner->notify(new NewReplyAdded($question));
        session()->flash('success', 'Your answer was submitted successfully');
        return redirect($question->url);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question,Answer $answer)
    {
        //
        return view('qa.answers.edit',compact('question','answer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Question $question, Answer $answer)
    {
        //
        Gate::authorize('update',$answer);
        $answer->update([
            'body' => $request->body,
        ]);

        session()->flash('success', 'Your answer was updated successfully');
        return redirect($question->url);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question, Answer $answer)
    {
        //
        Gate::authorize('delete',$answer);

        $answer->delete();
        session()->flash('success', 'Your answer was deleted successfully');
        return redirect($question->url);
    }

    public function markAsBest(Question $question, Answer $answer)
    {
        Gate::authorize('markAsBest',$answer);
        $answer->question->markBestAnswer($answer);
        return redirect()->back();
    }
}
