@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach ($records as $record)
                    <div class="card shadow record-view-card" style="margin-top: 20px">
                        <div class="card-header">
                            <h5><b><u>Case Title: </u></b> {{ $record->title }}</h5>
                            <b><u>Case Location: </u></b> {{ $record->location }}
                            <b><u>Case Date: </u></b> {{ $record->date }}
                        </div>
                        <div class="card-body">
                            <p>
                                <b>Client Name: {{ $record->clientname }} </b><br>

                            <p class="card-text">
                             KES   {{ $record->amount }}.
                            </p>
                            <p class="card-text">
                            </p>
                            <a href="/records/{{ $record->id }}" class="btn btn-lg btn-outline-dark">View </a>
                        </div>
                    </div>
                @endforeach
                {!! $records->links() !!}

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
        </div>
    </div>

@endsection
