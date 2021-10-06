@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header">{{ __('Add A document') }}</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            <form action="/records/{{$record->id}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="_method" hidden value="patch">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Title </label>
                                    <input type="text" class="form-control" value="{{$record->title}}" name="title" id="exampleFormControlInput1"
                                        placeholder="Title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Date</label>
                                    <input type="date" class="form-control" value="{{$record->date}}" name='date' id="exampleFormControlInput1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Location</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$record->location}}" name="location"
                                        placeholder="KIlimani..">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label"> Charges(KES) </label>
                                    <input type="number" class="form-control" id="exampleFormControlInput1" value="{{$record->amount}}" name="amount">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Decription
                                        textarea</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="dec" rows="3">{{$record->des}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Client Name</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" value="{{$record->clientname}}" name="name">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Client Email  Address</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" value="{{$record->email}}"
                                        placeholder="name@example.com">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Client Telephone
                                        Number</label>
                                    <input type="tel" class="form-control" id="exampleFormControlInput1" name="tel" value="{{$record->tel}}"
                                        placeholder="+254...">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Scanned Files(new Documents)</label>
                                    <input type="file" name="files[]" multiple class="form-control" id="exampleFormControlInput1"
                                        >
                                </div>
                                <button type="submit" class="btn btn btn-outline-secondary btn-lg"> Create Entry</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
