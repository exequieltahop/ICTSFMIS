<?php

use App\Http\Controllers\Auth\Dashboard;
use App\Http\Controllers\Auth\ExpensesController;
use App\Http\Controllers\Auth\Users;
use App\Http\Controllers\Guest\Index;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return view('pages.login'); })->name('login');
Route::post('/process-login', [Index::class, 'processLogin'])->name('process.login');
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
Route::get('/logout', [Index::class, 'logout'])->name('logout');

Route::get('/users', [Users::class, 'index'])->name('users');
Route::delete('/delete-user/{id}', [Users::class, 'deleteUser'])->name('delete.user');
Route::post('/add-user', [Users::class, 'addNewUser'])->name('add.user');
Route::put('/edit-user', [Users::class, 'editUser'])->name('edit.user');

Route::get('/expenses', [ExpensesController::class, 'index'])->name('expenses');
Route::post('/add-expanses', [ExpensesController::class, 'addExpenses'])->name('add.expenses');
Route::put('/edit-expanses', [ExpensesController::class, 'editExpenses'])->name('edit.expenses');
Route::delete('/remove-expanses/{id}', [ExpensesController::class, 'removeExpenses'])->name('remove.expenses');


Route::get('/test-email', function(){
    try {
        $status = Mail::to('resetanthem@gmail.com')->send(new TestMail('Carmelle'));

        return response("Success", 200);
    } catch (\Throwable $th) {
        throw $th;
    }
});