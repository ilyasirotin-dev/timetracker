<div class="row">
    <div class="container col-6">
        {{ flash.output() }}
        <h4>Change password</h4>
        <form method="post" action="{{ url('/password') }}">
            <div class="mb-3">
                {{ form.label('newPassword') }}
                {{ form.render('newPassword') }}
            </div>
            <div class="mb-3">
                {{ form.label('repeatPassword') }}
                {{ form.render('repeatPassword') }}
            </div>
            <div class="mb-3">
                {{ submit_button('Submit', 'class' : 'btn btn-primary') }}
            </div>
        </form>
    </div>
</div>
