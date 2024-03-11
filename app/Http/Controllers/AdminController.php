<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() {

        $user = Auth::user();
        return view('admin.profile', [
            'tickets' => Tickets::where('user_id' , $user->id)->get(),
            'user' => Auth::user()
        ]);
    }

    public function edit($id) {
        return view('admin.edit',[
            'ticket' => Tickets::find($id)
        ]);
    }

    public function update(Request $request , $id){
        $request->validate([
            'ticket-title' => 'required',
            'ticket-description' => 'required',
            'ticket-type' => 'required'
        ]);

        $ticket = Tickets::find($id);

        $ticket->title = $request->input('ticket-title');
        $ticket->description = $request->input('ticket-description');
        $ticket->type = $request->input('ticket-type');
        $ticket->status = $request->input('ticket-status');
        $ticket -> save();

        return to_route('home');
    }

    public function destroy($id) {
        $ticket = Tickets::find($id);
        $ticket -> delete();
        return to_route('home');
    }


    //users

    public function users_index() {
        return view('admin.users', [
            'users' => User::where('role' , 'editor')
                ->orWhere('role', 'user')
                ->get()->sortByDesc('created_at')
        ]);
    }

    public function destroy_user($id) {
        $user = User::find($id);
        $user -> delete();
        return to_route('users.index');
    }

    public function update_user(Request $request , $id) {
        $user = User::find($id);
        $user->role = $request->input('user-role');
        $user-> save();

        return to_route('users.index');
    }

}
