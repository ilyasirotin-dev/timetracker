<div class="container p-3">
    <form method="post" action="{{ action }}" name="dateSelector">
        <label>
            Select month:
            <select name="month" onchange="this.form.submit()">
                {% for monthNumber, monthName in view.monthList %}
                    <option value='{{ monthNumber }}' {{ monthNumber == selectedMonth ? 'selected' : '' }}>{{ monthName }}</option>
                {% endfor %}
            </select>
            Select year:
            <select name="year" onchange="this.form.submit()">
                {% for year in view.yearsList %}
                    <option {{ year == selectedYear ? 'selected' : '' }}>{{ year }}</option>
                {% endfor %}
            </select>
        </label>
    </form>
</div>