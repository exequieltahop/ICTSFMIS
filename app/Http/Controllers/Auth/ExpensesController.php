<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index() {
        try {
            return view('pages.expenses');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public
    public function addExpenses(Request $request) {
        try {

        } catch (\Throwable $th) {

        }
    }
}
