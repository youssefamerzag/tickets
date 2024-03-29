<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Attributes\Ticket;
use RealRashid\SweetAlert\Facades\Alert;

class TicketsController extends Controller
{
    public function index() {
        return view('home', [
            'Opentickets' => Tickets::where('status' , 'Open')->get()->sortByDesc('created_at'),
            'Closedtickets' => Tickets::where('status' , 'Closed')->get()->sortByDesc('created_at')
        ]);
    }

    public function show($id) {
        return view('ticket.show', [
            'ticket' => Tickets::find($id)
        ]);
    }

    public function create() {
        return view('ticket.create');
    }

    public function store(Request $request) {
        $request->validate([
            'ticket-title' => 'required',
            'ticket-description' => 'required',
            'ticket-type' => 'required',
            'ticket-file' => '' 
        ]);
    
        $user = Auth::user();
    
        $ticket = new Tickets();
        $ticket->title = $request->input('ticket-title');
        $ticket->description = $request->input('ticket-description');
        $ticket->type = $request->input('ticket-type');
        $ticket->user_id = $user->id;
    
        if($request->hasFile('ticket-file')) {
            $file = $request->file('ticket-file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('files'), $filename);
            $ticket->file = $filename; 
        }
        $ticket -> save();

        Alert::success('Success Title', 'Success Message')->persistent(true);
        return to_route('home');
        

    }

    public function edit($id) {
        return view('ticket.edit',[
            'ticket' => Tickets::find($id)
        ]);
    }

    public function update(Request $request , $id){
        $request->validate([
            'ticket-title' => 'required',
            'ticket-description' => 'required',
            'ticket-type' => 'required',
            'ticket-status' => ''
        ]);

        $ticket = Tickets::find($id);

        $ticket->title = $request->input('ticket-title');
        $ticket->description = $request->input('ticket-description');
        $ticket->type = $request->input('ticket-type');
        $ticket->status = $request->input('ticket-status');
        $ticket -> save();

        return to_route('users.show');
    }
    
}
