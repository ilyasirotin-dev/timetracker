<h4>Set late time</h4>
<form class="form-inline" action="{{ url('/latecomers/settime') }}" method="post">
    <div class="mb-3">
        <div class="row mb-2">
            <div class="col-1">
                {{ form.label('hours') }}
                {{ form.render('hours') }}
            </div>
            <div class="col-1">
                {{ form.label('minutes') }}
                {{ form.render('minutes') }}
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-1">
                <button type="submit" class="btn btn-primary mb-2">Submit</button>
            </div>
        </div>
    </div>
</form>
{{ partial('date_selector', ['action' : url('/latecomers')])}}
{{ partial('latecomers_table') }}