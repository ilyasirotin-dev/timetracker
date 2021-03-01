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
        <tr class="day_{{ date }}">
            <td>{{ date }}</td>
            {% for id, records in users %}
                <td class="id_{{ id }}">
                    {% if (id == session.get('auth')['id']) and (date == date('Y-m-d')) %}
                        {{ partial('log_buttons', ['id' : id, 'day' : date, 'isAdmin' : 'false']) }}
                    {% endif %}
                    {% for value in records %}
                        <div class="record_{{ value['id'] }}">
                            <input class="start" type="time" value="{{ value['start'] }}" disabled>
                            <span> - </span>
                            <input class="end" type="time" value="{{ value['end'] }}" disabled><br>
                        </div>
                    {% endfor %}
                </td>
            {% endfor %}
        </tr>
    {% endfor %}
</table>
