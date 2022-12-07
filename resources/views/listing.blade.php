@extends('layout')

@section('content')

<a href="/">Back</a>

<h2>{{ $listing['title'] }}</h2>
<p>{{ $listing['description'] }}</p>

@endsection