<table class="table table-bordered text-center">
    <thead>
    <tr>
        <td>#</td>
        <td>Name</td>
        <td>Username</td>
        <td>E-mail</td>
        <td>Role</td>
        <td>Active</td>
        <td></td>
    </tr>
    </thead>
    {% for user in view.usersList %}
        <tr>
            <td>{{ user.id }}</td>
            <td>{{ user.fname }} {{ user.lname }}</td>
            <td>{{ user.username }}</td>
            <td>{{ user.email }}</td>
            {% if user.is_admin === '1' %}
                <td>Admin</td>
            {% else %}
                <td>User</td>
            {% endif %}
            <td>{{ user.active }}</td>
            <td>
                {{ partial('action_button',
                    [
                        'action': url('/user/suspend/'~user.id),
                        'type': 'btn btn-danger',
                        'name': 'Suspend'
                    ]
                 )
                }}
            </td>
        </tr>
    {% endfor %}
</table>