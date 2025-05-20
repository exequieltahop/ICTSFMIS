@extends('layouts.app')

@section('title', 'Expenses')

@section('auth')

    <section class="container-fluid m-0 p-0">
        <div class="card shadow-lg">
            <div class="card-header d-flex align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-wallet"></i>
                    <h5 class="card-title m-0"> Expenses</h5>
                </div>
                @if (auth()->user()->role == 'treasurer')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-expenses">
                        <i class="bi bi-plus" style="font-style: normal;"> Add</i>
                    </button>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Event</th>
                            <th>Reciept</th>
                            @if (auth()->user()->role == 'treasurer')
                            <th>Action</th>
                            @endif
                        </thead>
                        <tbody>
                            @php
                            $expenses = App\Models\Expense::getAllData();
                            @endphp
                            @forelse ($expenses as $item)
                            <tr>
                                <td>{{$item->created_at->format('F j, Y')}}</td>
                                <td>{{$item->amount}}</td>
                                <td>{{$item->description}}</td>
                                <td>{{$item->category}}</td>
                                <td>{{$item->event}}</td>
                                <td>
                                    <img src="{{asset('storage/'. $item->reciept)}}" alt="img"
                                        style="width: 50px; height: 50px">
                                </td>
                                @if (auth()->user()->role == 'treasurer')
                                    <td class="text-center align-middle">
                                        <div class="dropdown">
                                            <i class="bi bi-three-dots-vertical" data-bs-toggle="dropdown"
                                                style="cursor: pointer;"></i>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-expenses-{{$loop->iteration}}">
                                                    <i class="bi bi-pencil-square text-primary" style="font-style: normal;">
                                                        Edit</i>
                                                </li>
                                                <li class="dropdown-item" style="cursor: pointer;" data-bs-toggle="modal"
                                                    data-bs-target="#modal-delete-item-{{$loop->iteration}}">
                                                    <i class="bi bi-trash-fill text-danger" style="font-style: normal;">
                                                        Delete</i>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            </tr>

                            {{-- modal delete comfirmation --}}
                            <div class="modal fade" tabindex="-1" aria-hidden="true"
                                id="modal-delete-item-{{$loop->iteration}}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            {{-- <h5 class="modal-title m-0">
                                                <i class="bi bi-wallet-fill text-danger" style="font-style: normal;"> Delete
                                                    Expenses</i>
                                            </h5> --}}
                                            <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 1.5em;">
                                            <form action="{{route('remove.expenses', ['id' => $item->enc_id])}}"
                                                method="POST" class="">
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" name="id" value="{{$item->enc_id}}">
                                                <h1 class="text-center text-danger" style="margin-block: 3em;">
                                                    <i class="bi bi-trash-fill" style="font-style: normal;">
                                                        Delete This Record?
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

                            {{-- modal edit expenses --}}
                            <div class="modal fade" tabindex="-1" aria-hidden="true"
                                id="modal-edit-expenses-{{$loop->iteration}}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title m-0">
                                                <i class="bi bi-wallet-fill text-primary" style="font-style: normal;"> Edit
                                                    Expenses</i>
                                            </h5>
                                            <button class="btn btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body" style="padding: 1.5em;">
                                            {{-- form pang add ug new record sa bayad --}}
                                            <form action="{{route('edit.expenses')}}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="id" value="{{$item->enc_id}}">
                                                <div class="mb-2">
                                                    <label for="amount" class="fw-bold">Amount</label>
                                                    <input type="number" name="amount" id="amount" step="any"
                                                        class="form-control" value="{{$item->amount}}" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="description" class="fw-bold">Description</label>
                                                    <textarea name="description" id="description"
                                                        class="form-control">{{$item->description}}</textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="category" class="fw-bold">category</label>
                                                    <select name="category" id="category" class="form-control">
                                                        <option value="">--SELECT CATEGORY--</option>
                                                        <option value="Office Supply" {{ $item->category == 'Office Supply'
                                                            ? 'selected' : '' }}>Office Supply</option>
                                                        <option value="Transportation" {{ $item->category ==
                                                            'Transportation' ? 'Transportation' : '' }}>Transportation
                                                        </option>
                                                        <option value="Honorarium" {{ $item->category == 'Honorarium' ?
                                                            'Honorarium' : '' }}>Honorarium</option>
                                                        <option value="Sponsorship" {{ $item->category == 'Sponsorship' ?
                                                            'Sponsorship' : '' }}>Sponsorship</option>
                                                        <option value="Meals" {{ $item->category == 'Meals' ? 'Meals' : ''
                                                            }}>Meals</option>
                                                        <option value="Snacks" {{ $item->category == 'Snacks' ? 'Snacks' :
                                                            '' }}>Snack</option>
                                                    </select>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="event" class="fw-bold">Event</label>
                                                    <input type="text" name="event" id="event" class="form-control"
                                                        value="{{$item->event}}" required>
                                                </div>

                                                <div class="mb-2">
                                                    <label for="reciept" class="fw-bold">Reciept</label>
                                                    <input type="file" name="reciept" id="reciept" class="form-control">
                                                </div>

                                                {{-- submit --}}
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-success">
                                                        <i class="bi bi-check" style="font-style: normal;"> Update</i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="7">No Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="pagination-wrapper">
                        {{$expenses->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal add expenses --}}
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-add-expenses">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0">
                        <i class="bi bi-wallet-fill text-primary" style="font-style: normal;"> Add Expenses</i>
                    </h5>
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" style="padding: 1.5em;">
                    {{-- form pang add ug new record sa bayad --}}
                    <form action="{{route('add.expenses')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2">
                            <label for="amount" class="fw-bold">Amount</label>
                            <input type="number" name="amount" id="amount" step="any" class="form-control" required>
                        </div>
                        <div class="mb-2">
                            <label for="description" class="fw-bold">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>
                        <div class="mb-2">
                            <label for="category" class="fw-bold">category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">--SELECT CATEGORY--</option>
                                <option value="Office Supply">Office Supply</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Honorarium">Honorarium</option>
                                <option value="Sponsorship">Sponsorship</option>
                                <option value="Meals">Meals</option>
                                <option value="Snacks">Snack</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="event" class="fw-bold">Event</label>
                            <input type="text" name="event" id="event" class="form-control" required>
                        </div>

                        <div class="mb-2">
                            <label for="reciept" class="fw-bold">Reciept</label>
                            <input type="file" name="reciept" id="reciept" class="form-control" required>
                        </div>

                        {{-- submit --}}
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success">
                                <i class="bi bi-check" style="font-style: normal;"> Submit</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection