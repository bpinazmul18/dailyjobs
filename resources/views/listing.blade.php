@extends('layout')

@section('content')
@include('partials._search')

<a href="/">Back</a>

<h2>{{ $listing['title'] }}</h2>
<p>{{ $listing['description'] }}</p>

@endsection
