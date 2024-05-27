<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request, string $id = null)
    {
        if($request->user()->can('read.ticket'))
        {
            if(!$id)
            {
                $tickets = Ticket::with('messages')->orderby('id', 'desc')->paginate(2);
                return response()->json($tickets);
            }
            else
            {
                $ticket = Ticket::with('messages')->find($id);
                return response()->json($ticket);
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
        if($request->user()->can('create.ticket'))
        {
            $ticket = Ticket::create($request->merge([
                'expires_at' => Carbon::now()->addDay(2)
            ])->toArray());
            return response()->json($ticket);
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
        if($request->user()->can('update.ticket'))
        {
        $ticket = Ticket::find($id)->update($request->toArray());
        return response()->json($ticket);
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
        if($request->user()->can('delete.ticket'))
        {
            Ticket::destroy($id);
        }
        else
        {
            return response()->json('User does not have the permission', 403);
        }
    }
}
