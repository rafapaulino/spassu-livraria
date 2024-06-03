@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('crud.sidebar')
            @include('autor.table')
        </div>
    </div>
@endsection