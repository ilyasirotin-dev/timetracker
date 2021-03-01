<table class="table table-bordered text-center">
    <thead>
    <tr>
        <td>#</td>
        <td>Name</td>
        <td>Date</td>
        <td>Description</td>
    </tr>
    </thead>
    {% for holiday in view.holidaysList %}
        <tr>
            <td>{{ holiday['id'] }}</td>
            <td>{{ holiday['name'] }}</td>
            <td>{{ holiday['date'] }}</td>
            <td>{{ holiday['description'] }}</td>
        </tr>
    {% endfor %}
</table>