@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('crud.sidebar')
            @include('assunto.table')
        </div>
    </div>
@endsection