{{ partial('statistic') }}
{{ partial('date_selector', ['action': url('/log')]) }}
{% if session.get('auth')['is_admin'] === '1' %}
    {{ partial('log_admin_table') }}
{% else %}
    {{ partial('log_user_table') }}
{% endif %}