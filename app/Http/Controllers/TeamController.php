<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.team'))
        {
            if(!$id)
            {
                $teams = Team::with('labels', 'tasks')->orderby('id', 'desc')->paginate(2);
                return response()->json($teams);
            }
            else
            {
                $team = Team::with('labels', 'tasks')->find($id);
                return response()->json($team);
            }
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->user()->can('create.team'))
        {
            $team = Team::create($request->toArray());
            $team->labels()->attach($request->label_ids);
            return response()->json($team);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.team'))
        {
            $team = Team::find($id);
            $team->update($request->toArray());
            $team->labels()->sync($request->label_ids);
            return response()->json($team);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.team'))
        {
            Team::destroy($id);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
