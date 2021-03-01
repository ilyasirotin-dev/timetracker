{% set is_admin = session.get('auth')['is_admin'] %}
{% set links = [
        'log': [
            'title': 'Log',
            'uri': url('/log'),
            'admin': '0'
        ],
        'password': [
            'title': 'Change password',
            'uri': url('/password'),
            'admin': '0'
        ],
        'users': [
            'title': 'Users List',
            'uri': url('/list'),
            'admin': '1'
        ],
        'create': [
            'title': 'Create user',
            'uri': url('/create'),
            'admin': '1'
        ],
        'holidays': [
            'title': 'Holidays',
            'uri': url('/holidays'),
            'admin': '0'
        ],
        'holidays_create': [
            'title': 'Create holiday',
            'uri': url('/holidays/create'),
            'admin': '1'
        ],
        'latecomers': [
            'title': 'Latecomers',
            'uri': url('/latecomers'),
            'admin': '1'
        ],
        'logout': [
            'title': 'Log out',
            'uri': url('/logout'),
            'admin': '0'
        ]
] %}

<div class="container p-3">
    <div class="row">
        <div class="col-4">
            <h1><a class="text-dark" href={{ url('/') }}>Hours Log</a></h1>
        </div>
        <div class="col-8">
            <ul class="nav justify-content-end">
                {% for link in links %}
                    {% if is_admin == '1' %}
                        <li class="nav-item">
                            <a class="nav-link" href={{ link['uri'] }}>
                                {{ link['title'] }}
                            </a>
                        </li>
                    {% elseif link['admin'] != '1' %}
                        <li class="nav-item">
                            <a class="nav-link" href={{ link['uri'] }}>
                                {{ link['title'] }}
                            </a>
                        </li>
                    {% endif %}
                {% endfor %}
            </ul>
        </div>
    </div>
</div>

<div class="container">
    {{ content() }}
</div>