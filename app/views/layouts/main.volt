{% set links = [
        'log': [
            'title': 'Log',
            'uri': url('/log')
        ],
        'account': [
            'title': 'Manage account',
            'uri': url('/account')
        ],
        'create': [
            'title': 'Create user',
            'uri': url('/create')
        ],
        'holidays': [
            'title': 'Holidays',
            'uri': url('/holidays')
        ],
        'latecomers': [
            'title': 'Latecomers',
            'uri': url('/latecomers')
        ]
] %}

<div class="container p-3">
    <div class="row">
        <div class="col-4">
            <h1>Hours Log</h1>
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