@extends('layouts.app')

@section('title', 'Page Title')



@section('content')
    <div class="row">
        <div class="col-md">
            <h1>Welcome to the Resort Status Page</h1>
        </div>
    </div>
@endsection
@section('sidebar')
    <div class="row">
        <div class="col-md">
            <h2>Recent Messages:</h2>
        </div>
    </div>
    @foreach ($todays_messages as $message)
        <div class="row">
            <div class="col-md">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $message->from }}</h5>
                        <p class="card-text">{{ $message->message }}</p>
                        <p class="card-text">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
@endsection