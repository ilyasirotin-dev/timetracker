<div class="container p-3">
    {{ partial('statistic') }}
</div>
<div class="container p-3">
    <form method="post" action="{{ url('/log') }}" name="selectMonth">
        <label>
            Select month:
            <select name="month" onchange="this.form.submit()">
                {% for monthNumber, month in view.monthList %}
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
            <td class="col-md-1"></td>
            {% for user in view.usersList %}
                <td>{{ user['fname'] }} {{ user['lname'] }}</td>
            {% endfor %}
        </tr>
    </thead>

    {% for date, users in view.records %}
        <tr>
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