{% set links = [
        'log': [
            'title': 'Log',
            'uri': url('/log')
        ],
        'password': [
            'title': 'Change password',
            'uri': url('/password')
        ],
        'users': [
            'title': 'Users List',
            'uri': url('/list')
        ],
        'create': [
            'title': 'Create user',
            'uri': url('/create')
        ],
        'holidays': [
            'title': 'Holidays',
            'uri': url('/holidays')
        ],
        'holidays_create': [
            'title': 'Create holiday',
            'uri': url('/holidays/create')
        ],
        'latecomers': [
            'title': 'Latecomers',
            'uri': url('/latecomers')
        ],
        'logout': [
            'title': 'Log out',
            'uri': url('/logout')
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
                    <li class="nav-item">
                        <a class="nav-link" href={{ link['uri'] }}>
                            {{ link['title'] }}
                        </a>
                    </li>
                {% endfor %}
            </ul>
        </div>
    </div>
</div>

<div class="container">
    {{ content() }}
</div>