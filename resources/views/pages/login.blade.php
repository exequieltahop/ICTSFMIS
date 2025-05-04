@extends('layouts.app')

@section('title' , 'Log In')

@section('guest')
<section class="container vh-100 d-grid" style="place-items: center;">
    <form action="{{route('process.login')}}" method="POST" class="p-5 shadow-lg rounded border bg-white w-100" style="max-width: 500px;">
        @csrf
        <input type="email" name="email" id="email" class="form-control mb-3" placeholder="example@email.com"
            autocomplete="email" data-bs-toggle="tooltip" title="Email" required >
        <input type="password" name="password" id="password" class="form-control mb-3" placeholder="********"
            minlength="8" autocomplete="current-password" data-bs-toggle="tooltip" title="Password" required>
        <button type="submit" class="btn btn-primary w-100" >
            <i class="bi bi-box-arrow-in-right text-uppercase fw-bold" style="font-style: normal;"> Sign In</i>
        </button>
    </form>
</section>
@endsection