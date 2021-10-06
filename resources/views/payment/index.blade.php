@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-3 alert alert-success shadow  m-1">

                <p>
                    <sup>Total Cases</sup>/
                    <sub>CLosed</sub>
                </p>
                <hr>
                <h4><sup> {{ count($records) }}</sup>/
                    <sub>{{ count($closed) }}</sub>
                </h4>


            </div>
            <div class="col-md-4 alert alert-danger shadow m-1 ">


                <p><sup>Receivable</sup>/
                    <sub>Paid</sub>
                </p>
                <hr>
                <h4><sup>KES {{ $records->sum('amount') }}</sup>/
                    <sub>KES {{ $payments->sum('amount') }}</sub>
                </h4>

            </div>

            <div class="col-md-4">
                Search

                <div class="card">
                    <br>
                    <div class="container">
                        <div class="mb-3">
                            <input type="text" class="form-control" onkeyup="bytitle()" id="s_title" name="tel">
                        </div>

                    </div>
                </div>

                <div class="card" id="search"></div>

            </div>


            <div class="col-md-10 mt-4">
                <ul class="list-group">

                    <li class="list-group-item active" aria-current="true">

                        <form action="/paymentSearch" method="POST">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        Get payment From
                                        <input type="date" class="form-control" name="start"
                                            id="exampleFormControlInput1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    Get payment to
                                    <input type="date" class="form-control" name="to" id="exampleFormControlInput1">
                                </div>
                                <button type="submit" class="btn ml-3 btn-dark text-white btn-outline-secondary btn-lg">
                                    Submit </button>

                            </div>
                        </form>
                        <h2> Payment History for last 30 days</h2>
                    </li>

                    @foreach ($paymentLest30 as $item)
                        <li class="list-group-item">KES {{ $item->amount }}
                            <h6 class="card-subtitle mb-2 text-muted">paid on: {{ $item->created_at }}</h6>
                            {{-- <h6 class="card-subtitle mb-2 text-muted">case : {{ $item->record }}</h6> --}}

                        </li>
                    @endforeach

                    <li class="list-group-item active" aria-current="true">
                        <h4>Total: {{ $paymentLest30->sum('amount') }}</h4>
                    </li>

                </ul>

            </div>
        </div>
    </div>

@endsection
