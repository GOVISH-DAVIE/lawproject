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
                        <div class="row">
                            <div class="col-md-7">
                                <h3 class="card-title">File Number: {{ $record->filenumber }}</h3>
                                <h3 class="card-title">Title: {{ $record->title }}</h3>
                                <h3 class="card-title">KES {{ $record->amount }}</h3>

                                <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>
                                <br>
                            </div>
                            <div class="col-md-4">
                                <a href="/notes/{{ $record->id }}" class="btn btn-lg btn-outline-dark"><i
                                        class="fa fa-edit" aria-hidden="true"></i> notes</a>
                                <br>
                                <br>
                                <a href="/calender/{{ $record->id }}" class="btn btn-lg btn-outline-dark"><i
                                        class="fa fa-calendar" aria-hidden="true"></i> Schedule </a>

                            </div>

                        </div>

                        <hr>

                        <br>

                        <form enctype="multipart/form-data" action="/notes/{{ $record->id }}" method="POST">
                            @csrf
                            <input type="text" name="_method" value="PUT" hidden>
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Add Notes</label>
                                <textarea class="form-control" name="notes" placeholder="type your notes here..."
                                    id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" name="sms" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Send as text</label>
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Scanned Files</label>
                                <input type="file" name="files[]" multiple class="form-control"
                                    id="exampleFormControlInput1">
                            </div>
                            <button type="submit" class=" btn btn-lg btn-outline-primary">Add Notes</button>
                        </form>


                    </div>

                </div>

                <br>
                <div class="card shadow">

                    <ul class="list-group">

                        <li class="list-group-item       bg-main" aria-current="true">Notes History</li>

                        @foreach ($record->notes as $item)
                            <li class="list-group-item">
                                <p> {{ $item->text }}</p>
                                <div class="container">
                                    @foreach (json_decode($item->files) as $file)
                                        <a href="/storage/{{ $file }}"
                                            class=" mb-200 btn btn-lg btn-outline-warning text-dark" target="_blank"
                                            class="card-link"><i
                                                class="fa fa-download fa-2x"></i>{{ $file }}</a>

                                    @endforeach
                                </div>
                                <br><br>
                                @if ($item->istexted == 'on')
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" checked class="custom-control-input" disabled
                                            id="customSwitch2">
                                        <label class="custom-control-label" for="customSwitch2">SMS sent to Client</label>
                                    </div>

                                @endif
                                <br>
                                <h6 class="card-subtitle mb-2 text-muted">Created on: {{ $item->created_at }}</h6>

                            </li>
                        @endforeach



                    </ul>
                </div>

            </div>



            <div class="col-md-4">
                <div class="card " style="border: none">
                    <div class="card-body">
                        <h1><u>Client Details</u></h1>
                        <h3 class="card-title">{{ $record->clientname }}</h3>
                        <h3 class="card-title"> {{ $record->tel }}</h3>
                        <h3 class="card-title"> {{ $record->email }}</h3>

                        <h6 class="card-subtitle mb-2 text-muted">{{ $record->date }}</h6>

                    </div>
                </div>
                <div class="card alert bg-body shadow  " style="margin-top: 20px">
                    <div class="card-body">
                        <form action="/payment" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label"> Your Message </label>
                                <textarea class="form-control" name="amount"></textarea>
                            </div>
                            <input hidden type="text" name="record" id="" value="{{ $record->id }}">
                            <button type="submit" class="btn btn btn-outline-secondary btn-lg">Send <i
                                    class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
