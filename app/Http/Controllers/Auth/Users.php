<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

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

    // delete user
    public function deleteUser($id) {
        try {
            $dec_id = Crypt::decrypt($id);

            $item = User::findOrFail($dec_id);

            $stat = $item->delete();

            if(!$stat){
                return redirect()->back()->withErrors('Failed To Deleted User');
            }

            return redirect()->back()->with('success', 'Successfully Deleted User');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }

    // edit user
    public function editUser(Request $request) {
        try {
            $request->validate([
                'id' => 'required',
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . Crypt::decrypt($request->id),
                'password' => 'nullable|min:8',
            ]);

            $dec_id = Crypt::decrypt($request->id);

            $item = User::findOrFail($dec_id);

            if($request->has('password')){
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ];
            }else{
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                ];
            }

            $stat = $item->update($data);

            if(!$stat){
                return redirect()->back()->withErrors('Failed To Update User');
            }

            return redirect()->back()->with('success', 'Successfully Update User');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }

    // add new user
    public function addNewUser(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8',
            ]);

            $stat = User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'password'=> Hash::make($request->password),
            ]);

            if(!$stat){
                return redirect()->back()->withErrors('Failed To Add New User');
            }

            return redirect()->back()->with('success', 'Successfully Added New User');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('Something Went Wrong!');
        }
    }
}
