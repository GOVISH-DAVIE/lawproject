@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach ($records as $record)
                    <div class="card" style="margin-top: 20px">
                        <div class="card-header">
                          <h5><b><u>Case Title: </u></b>  {{$record->title}}</h5>
                          <b><u>Case Location: </u></b>  {{$record->location}} 
                          <b><u>Case Date: </u></b>  {{$record->date}}
                        </div>
                        <div class="card-body"> 
                            <p> 
                               <b>Client Name: {{$record->clientname    }} </b><br>
                                
                            <p class="card-text">
                                {{$record->des}}.
                            </p>
                            <p class="card-text"> 
                            </p>
                            <a href="records/{{$record->id  }}" class="btn btn-primary">View All</a>
                        </div>
                    </div>
                @endforeach
                {!! $records->links() !!}

            </div>
            <div class="col-md-4">
                attributes
            </div>
        </div>
    </div>

@endsection
