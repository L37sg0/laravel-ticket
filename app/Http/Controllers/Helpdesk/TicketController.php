<?php

namespace App\Http\Controllers\Helpdesk;

use App\Exceptions\Helpdesk\ResourceNotFoundHttpException;
use App\Http\Requests\Helpdesk\Ticket\Create;
use App\Http\Requests\Helpdesk\Ticket\Delete;
use App\Http\Requests\Helpdesk\Ticket\Index;
use App\Http\Requests\Helpdesk\Ticket\Read;
use App\Http\Requests\Helpdesk\Ticket\Update;
use App\Models\Helpdesk\Ticket;
use Illuminate\Routing\Controller;

class TicketController extends Controller
{
    public function index(Index $request)
    {
        $resultsPerPage = 10;
        if ($filterPageResults = $request->get('per_page')) {
            $resultsPerPage = $filterPageResults;
        }
        $collection = Ticket::Paginate($resultsPerPage);
//        if ($search = $request->get('search')){
//            $collection = Ticket::search($search)->paginate($resultsPerPage);
//        }
        return response()->json($collection);
    }



    public function create(Create $request)
    {
        $ticket = new Ticket();
        foreach (Ticket::FILLABLE as $key) {
            $ticket->setAttribute($key, $request->get($key));
        }
        $ticket->save();
        return response()->json(['message' => 'Ticket created.' . $ticket->getAttribute(Ticket::FIELD_ID)], 201);
    }

    public function read(Read $request)
    {
        $ticket = Ticket::find($request->get('ticket_id'));
        if (!empty($ticket)) {
            return response()->json($ticket);
        }
        throw new ResourceNotFoundHttpException();
    }

    public function update(Update $request)
    {
        $ticket = Ticket::find($request->get('ticket_id'));
        if (!empty($ticket)) {
            foreach (Ticket::FILLABLE as $key) {
                if (!empty($request->get($key))) {
                    $ticket->setAttribute($key, $request->get($key))->save();
                }
            }
            return response()->json(['message' => 'Ticket updated.'], 201);
        }
        throw new ResourceNotFoundHttpException();
    }

    public function destroy(Delete $request)
    {
        $ticket = Ticket::find($request->get('ticket_id'));
        if (!empty($ticket)) {
            $ticket->delete();
            return response()->json(['message' => 'Ticket deleted.'], 201);
        }
        throw new ResourceNotFoundHttpException();
    }
}
