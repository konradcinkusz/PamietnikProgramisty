<!-- Dropdown for Category Selection -->
<div class="category-dropdown">
    <select id="category-selector" class="custom-dropdown">
        <option value="">All Categories</option>
        @foreach ($categories as $category)
        <option value="{{ $category->id }}" style="color: {{ $category->color_code }};">
            {{ $category->name }}
        </option>
        @endforeach
    </select>
</div>

<div class="timeline">
    @php
    $sortedEvents = $events->sortBy('start_date');
    @endphp

    @foreach ($sortedEvents as $event)

    <div class="timeline-event" data-category="{{ $event->category->id }}" style="border-color: {{ $event->category->color_code }};">
        <div class="timeline-event-start-date">
            {{ $event->start_date }}
        </div>
        <div class="timeline-event-content">
            <h3>{{ $event->name }}</h3>
            <p>{{ Str::limit($event->description, 150) }}...</p>
            <div><a href="/event-details/{{$event->id}}">(View details)</a></div>
        </div>
        <div class="timeline-event-end-date">
            {{ $event->end_date }}
        </div>
    </div>
    @endforeach
</div>

<script>
    // JavaScript to handle category selection and filtering
    const categorySelector = document.getElementById('category-selector');
    const timelineEvents = document.querySelectorAll('.timeline-event');

    categorySelector.addEventListener('change', () => {
        const selectedCategory = categorySelector.value;

        timelineEvents.forEach(event => {
            const eventCategory = event.getAttribute('data-category');
            if (selectedCategory === '' || selectedCategory === eventCategory) {
                event.style.visibility = 'visible';
            } else {
                event.style.visibility = 'hidden';
            }
        });
    });
</script>