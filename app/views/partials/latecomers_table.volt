<table class="table table-bordered text-center hours_log">
    <thead>
    <tr>
        <td class="col-md-1">
        </td>
        {% for user in view.usersList %}
            <td>{{ user['fname'] }} {{ user['lname'] }}</td>
        {% endfor %}
    </tr>
    </thead>

    {% for date, users in view.tableData %}
        <tr {{ date === date('Y-m-d') ? 'class=today' : '' }}>
            <td>{{ date }}</td>
            {% for id, records in users %}
                <td>
                    {% for value in records %}
                        <p>{{ value }}</p>
                        <a href="{{ url('/latecomers/delete/'~id~'/'~date) }}">Delete</a>
                    {% endfor %}
                </td>
            {% endfor %}
        </tr>
    {% endfor %}
</table>
