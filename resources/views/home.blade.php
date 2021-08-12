@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <div class="container">
        My Name is {{ $name }}
    </div>
@endsection