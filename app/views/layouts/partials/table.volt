<div class="container p-2">
    <form method="post" action="{{ url('/user') }}" name="selectMonth">
        <label>
            Select month:
            <select name="month" onchange="this.form.submit()">
                {% for monthNumber, month in view.monthNamesList %}
                    <option value='{{ monthNumber }}' {{ month['selected'] }}>{{ month['name'] }}</option>
                {% endfor %}
            </select>
            Select year:
            <select name="year" onchange="this.form.submit()">
                {% for year in view.yearsList %}
                    <option {{ year['selected'] }}>{{ year['year'] }}</option>
                {% endfor %}
            </select>
        </label>
    </form>
</div>
<table class="table table-bordered text-center">
    <thead>
        <tr>
            <td></td>
            {% for user in view.usersList %}
                <td>{{ user['fname'] }} {{ user['lname'] }}</td>
            {% endfor %}
        </tr>
    </thead>

    {% for date, users in view.table %}
        <tr>
            <td>{{ date }}</td>
            {% for values in users %}
                <td>
                    {% for record in values %}
                        <p>{{ record['start'] }}-{{ record['end'] }}</p>
                    {% endfor %}
                </td>
            {% endfor %}
        </tr>
    {% endfor %}

</table>