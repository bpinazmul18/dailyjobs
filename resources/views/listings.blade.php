@extends('layout')

@section('content')

<h1>{{ $heading }}</h1>

@unless(count($listings) == 0)

@foreach($listings as $listing)
    <a href="/listing/{{$listing['id']}}">
        <h2>{{ $listing['title'] }}</h2>
    </a>
    <p>{{ $listing['description'] }}</p>
@endforeach

@else
    <p>No listing found!</p>

@endunless

@endsection