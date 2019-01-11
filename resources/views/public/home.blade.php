@extends('layouts.app')

@section('title', 'Page Title')



@section('content')
    <div class="row">
        <div class="col-md">
            <h1>Welcome to the BBMR Status Page</h1>
            <h4>Message of the day - {{ \Carbon\Carbon::today()->toFormattedDateString() }}</h4>
            <div class="row">
                <div class="col">
                    <bbmr-motds></bbmr-motds>
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
    <bbmr-messages></bbmr-messages>

@endsection