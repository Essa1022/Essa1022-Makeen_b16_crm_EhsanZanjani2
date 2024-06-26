<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    // Tickets index
    public function index(Request $request)
    {
        if($request->user()->can('read.ticket'))
        {
                $tickets = Ticket::with('messages')->orderby('id', 'desc')->paginate(2);
                return $this->responseService->success_response($tickets);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Show specific Ticket
    public function show(Request $request, $id)
    {
        if ($request->user()->can('read.ticket'))
        {
            $ticket = Ticket::with('messages')->find($id);
            return $this->responseService->success_response($ticket);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Store a new Ticket
    public function store(Request $request)
    {
        if($request->user()->can('create.ticket'))
        {
            $ticket = Ticket::create($request->merge([
                'expires_at' => Carbon::now()->addDay(2)
            ])->toArray());
            return $this->responseService->success_response($ticket);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Update Ticket
    public function update(Request $request, string $id)
    {
        if($request->user()->can('update.ticket'))
        {
        $ticket = Ticket::find($id)->update($request->toArray());
        return $this->responseService->success_response($ticket);
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }

    // Destroy Tickets
    public function destroy(Request $request, string $id)
    {
        if($request->user()->can('delete.ticket'))
        {
            Ticket::destroy($id);
            return $this->responseService->delete_response();
        }
        else
        {
            return $this->responseService->unauthorized_response();
        }
    }
}
