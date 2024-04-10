@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Category</h1>
    <form action="/edit-category/{{$category->id}}" method="POST" class="form-horizontal">
        @csrf
        @method('PUT')

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-6">
                <input type="text" name="name" id="name" class="form-control" value="{{$category->name}}">
            </div>
        </div>

        <!-- Color Code -->
        <div class="form-group">
            <label for="color_code" class="col-sm-3 control-label">Color Code</label>
            <div class="col-sm-6">
                <input type="text" name="color_code" id="color_code" class="form-control" value="{{$category->color_code}}">
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
