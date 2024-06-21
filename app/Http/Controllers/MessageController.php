<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{

    // Messages index
    public function index(Request $request)
    {
        if($request->user()->can('read.message'))
        {
            $messages = Message::orderby('id', 'desc')->paginate(5);
            return $this->responseService->success_response($messages);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Message
    public function show(Request $request, $id)
    {
        if($request->user()->can('read.message'))
        {
            $message = Message::find($id);
            return $this->success_response($message);
        }
        else
        {
            return $this->unauthorized_response();
        }
    }

    // Store a new Message
    public function store(Request $request)
    {
        if($request->user()->can('create.message'))
        {
        $message = Message::create($request->toArray());
        return $this->responseService->success_response($message);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Message
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.message'))
        {
        $message = Message::find($id)->update();
        return $this->responseService->success_response($message);
        }
        return $this->responseService->unauthorized_response();
    }

    // Destroy Messages
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.message'))
        {
            Message::destroy($id);
            return $this->responseService->delete_response();
        }
        return $this->responseService->unauthorized_response();
    }
}
