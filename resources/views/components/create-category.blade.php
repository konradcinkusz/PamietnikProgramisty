@auth
<div class="col-sm-offset-2 col-sm-8 hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            New Category
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Category Form -->
            <form action="/create-category" method="POST" class="form-horizontal">
                @csrf

                <!-- Category Name -->
                <div class="form-group">
                    <label for="category-name" class="col-sm-3 control-label">Category Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="category-name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>

                <!-- Color Code (with jscolor color picker) -->
                <div class="form-group">
                    <label for="color-code" class="col-sm-3 control-label">Color Code</label>
                    <div class="col-sm-6">
                        <input type="text" name="color_code" id="color-code" class="form-control jscolor" value="{{ old('color_code') }}">
                    </div>
                </div>

                <!-- Add Category Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i>Add Category
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Current Categories -->
@if (count($categories) > 0)
<div class="col-sm-offset-2 col-sm-8 hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Categories
        </div>

        <div class="panel-body">
            <table class="table table-striped category-table">
                <thead>
                    <th>Category Name</th>
                    <th>Color Code</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td class="table-text">
                            <div><a href="/edit-category/{{$category->id}}">{{ $category->name }} (Edit)</a></div>
                        </td>
                        <td class="table-text">
                            <div style="background-color: {{ $category->color_code }}; width: 20px; height: 20px;"></div>
                        </td>
                        <!-- Category Delete Button -->
                        <td>
                            <form action="/delete-category/{{$category->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-btn fa-trash"></i>Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endauth