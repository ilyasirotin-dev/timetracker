<div class="row">
    <div class="container col-6">
        {{ flash.output() }}
        <h4>Add new holiday</h4>
        <form method="post" action="{{ url('/holidays/create') }}">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        {{ form.label('name') }}
                        {{ form.render('name') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('date') }}
                        {{ form.render('date') }}
                    </div>
                    <div class="col-3">
                        {{ form.label('repeatable') }}
                        {{ form.render('repeatable') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('description') }}
                        {{ form.render('description') }}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                {{ submit_button('Submit', 'class' : 'btn btn-primary') }}
            </div>
        </form>
    </div>
</div>
