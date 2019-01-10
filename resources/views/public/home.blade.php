@extends('layouts.app')

@section('title', 'Page Title')



@section('content')
    <div class="row">
        <div class="col-md">
            <h1>Welcome to the Resort Status Page</h1>
            <h4>Message of the day - {{ \Carbon\Carbon::today()->toFormattedDateString() }}</h4>
            <div class="row">
                <div class="col">
                    <bbmr-motd></bbmr-motd>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('sidebar')
    <div class="row">
        <div class="col-md">
            <h2>Recent Messages:</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            @foreach ($todays_messages as $message)
                <div class="card" style="">
                    <div class="card-header">
                        <span class="font-weight-bold">{{ $message->from }}</span> - {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                    </div>
                    <div class="card-body">
                        <p class="card-text">{!! $message->message !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection