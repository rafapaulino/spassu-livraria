@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('index.sidebar')
            @include('index.books')
        </div>
    </div>
@endsection