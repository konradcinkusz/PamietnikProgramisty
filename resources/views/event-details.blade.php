@extends('layouts.app')

@section('content')
<div class="event-details">
    <h1>{{ $event->name }}</h1>
    <p>{{ $event->description }}</p>
    <p>Start Date: {{ $event->start_date }}</p>
    <p>End Date: {{ $event->end_date }}</p>
    <a href="/">Back to Timeline</a>
</div>
@endsection
