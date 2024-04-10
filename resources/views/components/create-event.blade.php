@auth
<div class="col-sm-offset-2 col-sm-8 hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            New Event
        </div>

        <div class="panel-body">
            <!-- Display Validation Errors -->
            @include('common.errors')

            <!-- New Event Form -->
            <form action="/create-event" method="POST" class="form-horizontal">
                @csrf

                <!-- Event Name -->
                <div class="form-group">
                    <label for="event-name" class="col-sm-3 control-label">Event Name</label>
                    <div class="col-sm-6">
                        <input type="text" name="name" id="event-name" class="form-control" value="{{ old('name') }}">
                    </div>
                </div>

                <!-- Start Date -->
                <div class="form-group">
                    <label for="start-date" class="col-sm-3 control-label">Start Date</label>
                    <div class="col-sm-6">
                        <input type="date" name="start_date" id="start-date" class="form-control" value="{{ old('start_date') }}">
                    </div>
                </div>

                <!-- End Date -->
                <div class="form-group">
                    <label for="end-date" class="col-sm-3 control-label">End Date</label>
                    <div class="col-sm-6">
                        <input type="date" name="end_date" id="end-date" class="form-control" value="{{ old('end_date') }}">
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description" class="col-sm-3 control-label">Description</label>
                    <div class="col-sm-6">
                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label for="category-id" class="col-sm-3 control-label">Category</label>
                    <div class="col-sm-6">
                        <select name="category_id" id="category-id" class="form-control">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Add Event Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i>Add Event
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Current Events -->
@if (count($events) > 0)
<div class="col-sm-offset-2 col-sm-8  hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            Current Events
        </div>

        <div class="panel-body">
            <table class="table table-striped event-table">
                <thead>
                    <th>Event Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Description</th>
                    <th>Image Path</th>
                    <th>Category</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                    <tr>
                        <td class="table-text">
                            <div><a href="/edit-event/{{$event->id}}">{{ $event->name }} (Edit)</a></div>
                        </td>
                        <td class="table-text">{{ $event->start_date }}</td>
                        <td class="table-text">{{ $event->end_date }}</td>
                        <td class="table-text">{{ $event->description }}</td>
                        <td class="table-text">{{ $event->image_path }}</td>
                        <td class="table-text">{{ $event->category->name }}</td> <!-- Assuming a relationship with 'category' -->
                        <!-- Event Delete Button -->
                        <td>
                            <form action="/delete-event/{{$event->id}}" method="POST">
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