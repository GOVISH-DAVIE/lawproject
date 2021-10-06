@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Add A document') }}</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <form action="recods" method="POST" enctype="multipart/form-data">
                                {{ @csrf }}
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Title </label>
                                    <input type="text" class="form-control" name="title" id="exampleFormControlInput1"
                                        placeholder="Title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Date</label>
                                    <input type="date" class="form-control" name='date' id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Location</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="location"
                                        placeholder="KIlimani..">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Charges(KES) </label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" name="amount">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Decription
                                        textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="dec" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Client Email
                                        Address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email"
                                        placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Client Telephone
                                        Number</label>
                                    <input type="tel" class="form-control" id="exampleFormControlInput1" name="tel"
                                        placeholder="+254...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Scanned Files</label>
                                    <input type="file" name="files[]" class="form-control" id="exampleFormControlInput1"
                                        >
                                </div>
                                <button class="btn btn btn-outline-secondary btn-lg"> Create Entry</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
