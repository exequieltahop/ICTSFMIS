<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Users extends Controller
{
    public function index()  {
        try {
            $users = User::whereNot('role', 'admin')->paginate(10);
            // dd($users->links());
            return view('pages.users', [
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            return response(null, 500);
        }
    }
}
