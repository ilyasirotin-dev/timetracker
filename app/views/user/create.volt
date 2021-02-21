<div class="row">
    <div class="container col-6">
        {{ flash.output() }}
        <h4>Add new user</h4>
        <form method="post" action="{{ url('/create') }}">
            <div class="mb-3">
                <div class="row">
                    <div class="col">
                        {{ form.label('fname') }}
                        {{ form.render('fname') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('lname') }}
                        {{ form.render('lname') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('username') }}
                        {{ form.render('username') }}
                    </div>
                    <div class="col-3">
                        {{ form.label('is_admin') }}
                        {{ form.render('is_admin') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('email') }}
                        {{ form.render('email') }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        {{ form.label('password') }}
                        {{ form.render('password') }}
                    </div>
                    <div class="col">
                        {{ form.label('repeatPassword') }}
                        {{ form.render('repeatPassword') }}
                    </div>
                </div>
            </div>
            <div class="mb-3">
                {{ submit_button('Submit', 'class' : 'btn btn-primary') }}
            </div>
        </form>
    </div>
</div>
