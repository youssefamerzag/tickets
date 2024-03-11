<?php

namespace App\Http\Controllers;

use App\Models\Tickets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function show() {
        $user = Auth::user();
        return view('user.profile', [
            'user' => $user,
            'tickets' => Tickets::where('user_id' , $user->id)->get()
        ]);
    }

    public function destroy($id) {
        $ticket = Tickets::find($id);
        $ticket -> delete();
        return to_route('home');
    }
}
