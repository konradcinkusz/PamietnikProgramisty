@auth
<div class="col-sm-offset-2 col-sm-8 hidden-print">
    <div class="panel panel-default">
        <div class="panel-heading">
            Seeder
        </div>
        <div class="panel-body">
            <p>Clicking the "Seed Data" button will check if categories and events have already been seeded. If not, it will seed sample data, and you will receive a confirmation message.</p>

            <!-- Seed Data Button -->
            <div class="form-group">
                <form action="/admin-seed" method="GET">
                    <button type="submit" class="btn btn-primary">
                        Seed Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endauth