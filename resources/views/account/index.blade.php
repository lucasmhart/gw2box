@extends('layout.main')
@section('content')
    <div class="container">
        <input type="hidden" name="gwo" id="gwo" value="{{ $gwObject }}">
        <p>test</p>
        <gw-account></gw-account>
    </div>
@endsection
