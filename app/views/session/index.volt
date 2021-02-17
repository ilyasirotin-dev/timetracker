<div class="container my-5 col-4 justify-content-center">
    <h1>LogIn</h1>
    <form method="post" action="{{ url('/send') }}">
        <div class="mb-3">
            {{ form.label('email') }}
            {{ form.render('email', ['class' : 'form-control']) }}
        </div>
        <div class="mb-3">
            {{ form.label('password') }}
            {{ form.render('password', ['class' : 'form-control']) }}
        </div>
        <div class="mb-3">
            {{ submit_button('Submit', 'class' : 'btn btn-primary') }}
        </div>
        <input type='hidden' name='{{ security.getTokenKey() }}'
               value='{{ security.getToken() }}'/>
    </form>
</div>