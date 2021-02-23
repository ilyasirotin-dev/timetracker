<table class="table table-bordered text-center" id="hours_log">
    <thead>
        <tr>
            <td class="col-md-1">
                <a href='javascript://' onclick='toggleRows();'>Hide/Show</a>
            </td>
            {% for user in view.usersList %}
                <td>{{ user['fname'] }} {{ user['lname'] }}</td>
            {% endfor %}
        </tr>
    </thead>

    {% for date, users in view.records %}
        <tr class={{ date === date('Y-m-d') ? 'today' : '' }}>
            <td>{{ date }}</td>
            {% for records in users %}
                <td>
                    {% for value in records %}
                        <p>{{ value }}</p>
                    {% endfor %}
                </td>
            {% endfor %}
        </tr>
    {% endfor %}
</table>