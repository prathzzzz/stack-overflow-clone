<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Gate;

class FavoritesController extends Controller
{
    //

    public function store(Question $question)
    {
        Gate::authorize('markAsFavorite', $question);
        $question->favorites()->attach(auth()->id());
        return redirect()->back();
    }

    public function destroy(Question $question)
    {
        Gate::authorize('markAsFavorite', $question);
        $question->favorites()->detach(auth()->id());
        return redirect()->back();
    }
}
