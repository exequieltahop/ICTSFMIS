<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ExpensesController extends Controller
{
    public function index()
    {
        try {
            return view('pages.expenses');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // public
    public function addExpenses(Request $request)
    {
        try {
            // dd($request->all());
            // validate
            $request->validate([
                'date' => 'required',
                'amount' => ['required', 'numeric'],
                'description' => ['required'],
                'category' => 'required',
                'event' => 'required',
                'reciept' => ['required', 'mimes:jpg,png,jpeg', 'max:10240']
            ]);

            if ($request->hasFile('reciept')) {
                $path = Storage::disk('public')
                    ->putFileAs(
                        'resibo',
                        $request->file('reciept'),
                        $request->file('reciept')->getClientOriginalName(),
                    );
            }
            // dd($path);
            if ($path) {
                // add record in the database
                $status = Expense::create([
                    'date' => $request->date,
                    'amount' => $request->amount,
                    'description' => $request->description,
                    'category' => $request->category,
                    'event' => $request->event,
                    'reciept' => $path,
                ]);
            }

            // check if success if not then return redirect with errors
            if (!$status) {
                return redirect()->back()->withErrors('Failed to add record');
            }

            // if all was ok then return with success message
            return redirect()->back()->with('success', 'Successfully added record!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->back()->withErrors('Failed to add record'); // return with error
        }
    }

    // remove expenses
    public function removeExpenses($id)
    {
        try {
            $dec_id = Crypt::decrypt($id);

            $item = Expense::findOrFail($dec_id);

            $status = $item->delete();

            if (!$status) {
                return redirect()->back()->withErrors("Failed to delete expenses!");
            }

            return redirect()->back()->with('success', 'Successfully Delete Expenses!');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors("Something went wrong!");
        }
    }

    // edit expenses
    public function editExpenses(Request $request)
    {
        try {

            $request->validate([
                'id' => ['required'],
                'date' => 'required',
                'amount' => ['required', 'numeric'],
                'description' => ['required'],
                'category' => ['required'],
                'event' => ['required'],
                'reciept' => ['mimes:png,jpg,jpeg', 'max:10240'],
            ]);

            $dec_id = Crypt::decrypt($request->id);

            $item = Expense::findOrFail($dec_id);

            if ($request->hasFile('reciept')) {
                if (Storage::disk('public')->exists('storage/'.$item->reciept)) {
                    Storage::disk('public')->delete(['storage/'.$item->reciept]);
                }
                $path = Storage::disk('public')->putFileAs('storage/resibo', $request->file('reciept'), $request->file('reciept')->getClientOriginalName());
            }else{
                $path = $item->reciept;
            }

            if ($path) {
                $edit_status = $item->update([
                    'date' => $request->date,
                    'amount' => $request->amount,
                    'description' => $request->description,
                    'category' => $request->category,
                    'event' => $request->event,
                    'reciept' => $path,
                ]);
            }

            if(!$edit_status){
                return redirect()->back()->withErrors("Failed to update expenses!");
            }

            return redirect()->back()->with("success", "Successfully update expenses!");
        } catch (\Throwable $th) {
            throw $th;
            // return redirect()->back()->withErrors("Something went wrong!");
        }
    }
}
