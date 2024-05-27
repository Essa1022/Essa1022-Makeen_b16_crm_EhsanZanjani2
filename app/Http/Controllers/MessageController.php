<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.message'))
        {
        if(!$id)
        {
            $messages = Message::orderby('id', 'desc')->paginate(2);
            return response()->json($messages);
        }
        else
        {
            $message = Message::find($id);
            return response()->json($message);
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
        if($request->user()->can('create.message'))
        {
        $message = Message::create($request->toArray());
        return response()->json($message);
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
        if($request->user()->can('update.message'))
        {
        $message = Message::find($id)->update();
        return response()->json($message);
        }
        return response()->json('User does not have the permission', 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.message'))
        {
            Message::destroy($id);
        }
        return response()->json('User does not have the permission', 403);
    }
}
