@extends('layouts.app')

@section('content')
<div class="container">
    @component('components.create-category', ['categories' => $categories])
    @endcomponent

    @component('components.create-event', ['events' => $events, 'categories' => $categories])
    @endcomponent
    
    <div class="col-sm-offset-2 col-sm-8" style="margin-bottom: 20px; margin-top: 20px;">
        @component('components.timeline', ['events' => $events, 'categories' => $categories])
        @endcomponent
    </div>

    @component('components.seed-data')
    @endcomponent
</div>
@endsection