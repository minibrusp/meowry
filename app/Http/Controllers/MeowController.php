<?php

namespace App\Http\Controllers;

use App\Models\Meow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $meows = Meow::where('user_id', Auth::id())->latest('updated_at')->paginate(5);
        $meows = Meow::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('meows.index')->with('meows', $meows);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('meows.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        Auth::user()->meow()->create([
            'uuid' => Str::uuid(),
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('meows.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meow $meow)
    {
        //

        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }


        return view('meows.show')->with('meow', $meow);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meow $meow)
    {
        //
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }


        return view('meows.edit')->with('meow', $meow);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meow $meow)
    {
        //
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }

        $request->validate([
            'title' => 'required|max:120',
            'text' => 'required'
        ]);

        $meow->update([
            'title' => $request->title,
            'text' => $request->text
        ]);

        return to_route('meows.show', $meow)->with('success', 'Meow successfully updated.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meow $meow)
    {
        //
        if(!$meow->user->is(Auth::user())) {
            return abort(403);
        }

        $meow->delete();

        return to_route('meows.index')->with('success', 'Meow moved to trash');

    }
}
