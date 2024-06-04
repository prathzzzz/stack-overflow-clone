<?php

namespace App\Http\Controllers;

use App\Http\Requests\Questions\CreateQuestionRequest;
use App\Http\Requests\Questions\UpdateQuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class QuestionsController extends Controller implements HasMiddleware
{
    public static function middleware() : array
    {
        return [
            new Middleware('auth',only:['create','store']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $questions = Question::with('owner')->latest()->paginate(10);
        return view('qa.layouts.questions.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('qa.layouts.questions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateQuestionRequest $request)
    {
        //
        auth()->user()->questions()->create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        session()->flash('success','Question has been added succesfully');
        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
        return view('qa.layouts.questions.edit',compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
        $question->update([
            'title' => $request->title,
            'body' => $request->body
        ]);
        return redirect(route('questions.index'))->with('success','Question has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        //
    }
}
