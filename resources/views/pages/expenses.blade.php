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
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add-expenses">
                    <i class="bi bi-plus" style="font-style: normal;" > Add</i>
                </button>
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
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lorem.</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td>Lorem.</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem, ipsum.</td>
                                <td>Lorem.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- modal add expenses --}}
    <div class="modal fade" tabindex="-1" aria-hidden="true" id="modal-add-expenses" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0">
                        <i class="bi bi-wallet-fill text-primary" style="font-style: normal;"> Add Expenses</i>
                    </h5>
                </div>
                <div class="modal-body" style="padding: 1.5em;">
                    <form action="" class="" action="" method="POST" enctype="multipart/form-data">
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
                                <option value="Office Supplies">Office Supplies</option>
                                <option value="Transportation">Transportation</option>
                                <option value="Honorarium">Honorarium</option>
                                <option value="Sponsorship">Sponsorship</option>
                                <option value="Meals">Meals</option>
                                <option value="Snack">Snack</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label for="event" class="fw-bold">Amount</label>
                            <input type="number" name="event" id="event" step="any" class="form-control" required>
                        </div>

                         <div class="mb-2">
                            <label for="reciept" class="fw-bold">Reqciept</label>
                            <input type="file" name="reciept" id="reciept" step="any" class="form-control" required>
                        </div>

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