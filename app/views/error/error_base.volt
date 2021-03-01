{# error/error_base.volt #}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="error-template">
                <h1>Error!</h1>
                <h2>{% block err_code %}{% endblock %}</h2>
                <div class="error-details">
                    {% block err_message %}{% endblock %}
                </div>
                <div class="error-actions">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>