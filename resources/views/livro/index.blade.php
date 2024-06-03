@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            @include('crud.sidebar')
            @include('livro.table')
        </div>
    </div>
@endsection