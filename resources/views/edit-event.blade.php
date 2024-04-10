@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Event</h1>
    <form action="/edit-event/{{$event->id}}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

        <!-- Event Name -->
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Event Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$event->name}}">
            </div>
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date" class="col-sm-3 control-label">Start Date</label>
            <div class="col-sm-6">
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{$event->start_date}}">
            </div>
        </div>

        <!-- End Date -->
        <div class="form-group">
            <label for="end_date" class="col-sm-3 control-label">End Date</label>
            <div class="col-sm-6">
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{$event->end_date}}">
            </div>
        </div>

        <!-- Description -->
        <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Description</label>
            <div class="col-sm-6">
                <textarea name="description" id="description" class="form-control">{{$event->description}}</textarea>
            </div>
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="category_id" class="col-sm-3 control-label">Category</label>
            <div class="col-sm-6">
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" @if($category->id === $event->category_id) selected @endif>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Save Changes Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
