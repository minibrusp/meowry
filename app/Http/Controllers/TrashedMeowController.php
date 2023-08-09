<?php

namespace App\Http\Controllers;

use App\Models\Meow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrashedMeowController extends Controller
{
    //
    public function index() {
        
        $meows = Meow::whereBelongsTo(Auth::user())->onlyTrashed()->latest('updated_at')->paginate(5);
        return view('meows.index')->with('meows', $meows);
    }

    public function show(Meow $meow) {
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }

        return view('meows.show')->with('meow', $meow);
    }

    public function update(Meow $meow) {
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }

        $meow->restore();

        return to_route('meows.show', $meow)->with('success', 'Meow restored.');
    }

    public function destroy(Meow $meow) {
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }

        $meow->forceDelete();

        return to_route('trashed.index', $meow)->with('success', 'Meow deleted forever');
    }
}
