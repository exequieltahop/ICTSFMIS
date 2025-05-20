@extends('layouts.app')

@section('title', 'Users')

@section('auth')
<section class="container-fluid p-0">
    <div class="card rounded-0 border shadow-lg">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0"> Users List</h5>
            <button class="btn" data-bs-toggle="modal" data-bs-target="#modal-add-new-user">
                <i class="bi bi-plus text-primary fw-bold" style="font-style: normal;"> Add</i>
            </button>
        </div>
        <div class="card-body table-responsive">
            <table class="table">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Created</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->created_at != null ? $item->created_at->format('Y-m-d') : ''}}</td>
                        <td class="text-center">
                            <div class="dropdown">
                                <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                    style="cursor: pointer;"></i>
                                <ul class="dropdown-menu">
                                    <li class="dropdown-item text-warning" style="cursor: pointer;"
                                        data-id="{{Illuminate\Support\Facades\Crypt::encrypt($item->id)}}" data-bs-toggle="modal" data-bs-target="#modal-edit-user-{{$loop->iteration}}">
                                        <i class="bi bi-pencil-square text-uppercase fw-bold"
                                            style="font-style: normal; letter-spacing: 1px;"> Edit</i>
                                    </li>
                                    <li class="dropdown-item text-danger" style="cursor: pointer;"
                                        data-id="{{Illuminate\Support\Facades\Crypt::encrypt($item->id)}}"
                                        data-bs-toggle="modal" data-bs-target="#modal-delete-user-{{$loop->iteration}}">
                                        <i class="bi bi-trash text-uppercase fw-bold"
                                            style="font-style: normal; letter-spacing: 1px;"> Delete</i>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    {{-- modal delete comfirmation --}}
                    <div class="modal fade" tabindex="-1" aria-hidden="true"
                        id="modal-delete-user-{{$loop->iteration}}">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body" style="padding: 1.5em;">
                                    <form
                                        action="{{route('delete.user', ['id' => Illuminate\Support\Facades\Crypt::encrypt($item->id)])}}"
                                        method="POST" class="">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id"
                                            value="{{Illuminate\Support\Facades\Crypt::encrypt($item->id)}}">
                                        <h1 class="text-center text-danger" style="margin-block: 3em;">
                                            <i class="bi bi-trash-fill" style="font-style: normal;">
                                                Delete This User?
                                            </i>
                                        </h1>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <button class="btn btn-primary" type="button"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- modal edit form --}}
                    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-edit-user-{{$loop->iteration}}"
                        aria-labelledby="#modal-add-new-user-title">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-primary m-0" id="modal-add-new-user-title"> Edit User
                                    </h5>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('edit.user')}}" class="p-3" method="POST" >
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="id" value="{{Illuminate\Support\Facades\Crypt::encrypt($item->id)}}">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                autocomplete="name" value="{{$item->name}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control"
                                                autocomplete="email" value="{{$item->email}}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" id="password" class="form-control"
                                                autocomplete="current-password" minlength="8">
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">
                                                <i class="bi bi-x" style="font-style: normal;"> Cancel</i>
                                            </button>
                                            <button class="btn btn-primary" type="submit">
                                                <i class="bi bi-check" style="font-style: normal;"> Update</i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{$users->links()}}
        </div>
    </div>
</section>

<div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-add-new-user"
    aria-labelledby="#modal-add-new-user-title">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary m-0" id="modal-add-new-user-title"> Add New User</h5>
            </div>
            <div class="modal-body">
                <form action="{{route('add.user')}}" class="p-3" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" autocomplete="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" autocomplete="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control"
                            autocomplete="current-password" minlength="8" required>
                    </div>
                    <div class="d-flex align-items-center justify-content-end gap-2">
                        <button class="btn btn-danger" type="button" data-bs-dismiss="modal">
                            <i class="bi bi-x" style="font-style: normal;"> Cancel</i>
                        </button>
                        <button class="btn btn-primary" type="submit">
                            <i class="bi bi-check" style="font-style: normal;"> Submit</i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection