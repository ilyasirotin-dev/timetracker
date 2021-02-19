{{ flash.output() }}
<div class="row">
    <div class="container col-4">
        <h4>Add new user</h4>
        <form method="post" action="{{ url('/admin/add') }}">
            {% for element in form %}
                <div class="mb-3">
                    {{ form.label(element.getName()) }}
                    {{ form.render(element.getName(), ['class' :  'form-control']) }}
                </div>
            {% endfor %}
            <div class="mb-3">
                {{ submit_button('Submit', 'class' : 'btn btn-primary justify-content-end') }}
            </div>
        </form>
    </div>
</div>
