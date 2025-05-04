<?php

use App\Http\Controllers\Auth\Dashboard;
use App\Http\Controllers\Auth\Users;
use App\Http\Controllers\Guest\Index;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){ return view('pages.login'); })->name('login');
Route::post('/process-login', [Index::class, 'processLogin'])->name('process.login');
Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
Route::get('/logout', [Index::class, 'logout'])->name('logout');
Route::get('/users', [Users::class, 'index'])->name('users');