<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{

    // Teams index
    public function index(Request $request)
    {
        if($request->user()->can('read.team'))
        {
                $teams = Team::with('labels', 'tasks')->orderby('id', 'desc')->paginate(2);
                return $this->responseService->success_response($teams);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Team
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.team'))
        {
            $team = Team::with('labels', 'tasks')->find($id);
            return $this->responseService->success_response($team);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Team
    public function store(Request $request)
    {
        if($request->user()->can('create.team'))
        {
            $team = Team::create($request->toArray());
            $team->labels()->attach($request->label_ids);
            return $this->responseService->success_response($team);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Team
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.team'))
        {
            $team = Team::find($id);
            $team->update($request->toArray());
            $team->labels()->sync($request->label_ids);
            return $this->responseService->success_response($team);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Teams
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.team'))
        {
            Team::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
