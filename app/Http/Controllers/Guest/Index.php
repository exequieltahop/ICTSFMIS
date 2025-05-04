<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Index extends Controller
{
    public function processLogin(Request $request) {
        try {
            $validated_payload = $request->validate([
                'email' => 'required',
                'password' => ['required', 'min:8'],
            ]);

            if(!Auth::attempt($validated_payload)){
                throw new \Exception('', 404);
            }

            return redirect()->route('dashboard')->with('success', 'Successfully Sign In');

        } catch (\Throwable $th) {

            $code = $th->getCode();

            if($code == 404){
                return redirect()->back()->withErrors("Invalid Credentials!");
            }else {
                return redirect()->back()->withErrors("Check Email or password was invalid!");
            }
        }
    }

    public function logout() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    }
}
