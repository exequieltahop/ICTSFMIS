<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index() {
        try {
            return view('pages.dashboard');
        } catch (\Throwable $th) {
            return response(null, 500);
        }
    }
}
