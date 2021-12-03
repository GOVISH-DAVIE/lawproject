@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                @if ($record->closed == 'close')
                    <div class="alert alert-warning" role="alert">
                        Case Closed
                    </div>

                @endif
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">File Number: {{ $record->filenumber }}</h3>
                        <h3 class="card-title">{{ $record->title }}</h3>
                        <h3 class="card-title">KES {{ $record->amount }}</h3>

                        <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>
                        <hr>
                        <div>
                            <H4>Documents</H4>
                            @foreach (json_decode($record->docs) as $doc)
                                <a href="/storage/{{ $doc }}" class="btn btn-lg btn-outline-dark" target="_blank"
                                    class="card-link"><i class="fa fa-download fa-2x"></i>{{ $doc }}</a>
                            @endforeach
                            <hr>
                        </div>
                        <br>
                        <p class="card-text">
                            {{ $record->des }}
                        </p>
                        <div class="row">


                            <div class="col-md-4">
                                <form action="/payment/{{ $record->id }}" method="POST">
                                    @csrf
                                    <input type="text" name="_method" value="delete" hidden>
                                    <button type="submit" class="btn btn btn-outline-danger btn-lg">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete</button>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <a href="/records/{{ $record->id }}/edit"
                                    class="btn btn btn-outline-success btn-lg">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                    Edit</a>
                            </div>
                            <div class="col-md-4">
                                @if ($record->closed !== 'close')
                                    <a href="/recordsclose/{{ $record->id }}"
                                        class=" pt-200 btn text-dark btn-outline-warning btn-lg">
                                        
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                        Close  Case</a>
                                @endif
                            </div>
                        </div>


                    </div>

                </div>

                <br>
                <div class="card shadow">

                    <ul class="list-group">

                        <li class="list-group-item active" aria-current="true">Payment History</li>

                        @foreach ($record->payments as $item)
                            <li class="list-group-item">KES {{ $item->amount }}
                                <h6 class="card-subtitle mb-2 text-muted">paid on: {{ $item->created_at }}</h6>

                            </li>
                        @endforeach

                        <li class="list-group-item active" aria-current="true">
                            <h4>Total: {{ $record->payments->sum('amount') }}</h4>
                        </li>

                    </ul>
                </div>
            </div>



            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1><u>Client Details</u></h1>
                        <h3 class="card-title">{{ $record->clientname }}</h3>
                        <h3 class="card-title"> {{ $record->tel }}</h3>
                        <h3 class="card-title"> {{ $record->email }}</h3>

                        <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>

                    </div>
                </div>
                <div class="card alert alert-secondary   " style="margin-top: 20px">
                    <div class="card-body">
                        <p> <b>Receivable:</b> {{ $record->amount }}</p>
                        <p> <b>Paid:</b> {{ $record->payments->sum('amount') }}</p>
                        <p> <b>balance:</b> {{ intval($record->amount) - intval($record->payments->sum('amount')) }}</p>
                        <form action="/payment" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"> Charges(KES) </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="amount">
                            </div>
                            <input hidden type="text" name="record" id="" value="{{ $record->id }}">
                            <button type="submit" class="btn btn btn-outline-secondary btn-lg">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="card alert alert-secondary   " style="margin-top: 20px">
                    <div class="card-body">
                        <p> <b>Receivable:</b> {{ $record->amount }}</p>
                        <p> <b>balance:</b> {{ intval($record->amount) - intval($record->payments->sum('amount')) }}</p>
                        <form action="/payment/over" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"> Charges(KES) </label>
                                <input type="number" class="form-control" id="exampleFormControlInput1" name="amount">
                            </div>
                            <input type="text" name="_method" value="PUT" hidden>
                            <input hidden type="text" name="record" id="" value="{{ $record->id }}">
                            <button type="submit" class="btn btn btn-outline-secondary btn-lg">Over Charge</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
