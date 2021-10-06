@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $record->title }}</h3>
                        <h3 class="card-title">KES {{ $record->amount }}</h3>

                        <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>
                        <hr>
                        <div>
                            <H4>Documents</H4>
                            @foreach (json_decode($record->docs) as $doc)
                                <a href="/storage/{{ $doc }}" target="_blank" class="card-link">{{$doc}}</a>
                            @endforeach
                            <hr>
                        </div>
                        <br>
                        <p class="card-text">
                            {{ $record->des }}
                        </p>
                        <a href="#" class="btn btn btn-outline-secondary btn-lg">Delete</a>
                        <a href="/records/{{$record->id}}/edit" class="btn btn btn-outline-secondary btn-lg">Edit</a>
                    </div>
                </div> 

            </div>

            
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">{{ $record->clientname }}</h3>
                        <h3 class="card-title"> {{ $record->tel }}</h3>
                        <h3 class="card-title"> {{ $record->email }}</h3>

                        <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>
                         
                    </div>
                </div> 
            </div>

        </div>
    </div>

@endsection
