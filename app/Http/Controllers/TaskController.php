<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if ($request->user()->can('read.task'))
        {
            if (!$id)
            {
                $tasks = Task::with('taskable')->orderby('id', 'desc')->paginate(2);
                return response()->json($tasks);
            }
            else
            {
                $task = Task::with('taskable')->find($id);
                return response()->json($task);
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
        if ($request->user()->can('create.task'))
        {
            $task = Task::create($request->toArray());
            return response()->json($task);
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
        if ($request->user()->can('update.task'))
        {
            $task = Task::find($id)->update($request->toArray());
            return response()->json($task);
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
        if ($request->user()->can('delete.team'))
        {
            $task = Task::destroy($id);
            return response()->json($task);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
