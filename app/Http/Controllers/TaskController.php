<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    // Tasks index
    public function index(Request $request)
    {
        if ($request->user()->can('read.task'))
        {
                $tasks = Task::with('taskable')->orderby('id', 'desc')->paginate(2);
                return $this->responseService->success_response($tasks);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Task
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.task'))
        {
            $task = Task::with('taskable')->find($id);
            return $this->responseService->success_response($task);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Task
    public function store(Request $request)
    {
        if ($request->user()->can('create.task'))
        {
            $task = Task::create($request->toArray());
            return $this->responseService->success_response($task);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Task
    public function update(Request $request, string $id)
    {
        if ($request->user()->can('update.task'))
        {
            $task = Task::find($id)->update($request->toArray());
            return $this->responseService->success_response($task);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Tasks
    public function destroy(Request $request, string $id)
    {
        if ($request->user()->can('delete.team'))
        {
            Task::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
