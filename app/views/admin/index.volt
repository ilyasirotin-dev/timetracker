<h2>Users list</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>#</td>
            <td>Username</td>
            <td>Email</td>
            <td>Admin</td>
            <td>Active</td>
            <td></td>
        </tr>
    </thead>
    {% for user in userList %}
        <tr>
            {% for column in user %}
                <td>{{ column }}</td>
            {% endfor %}
            <td class="text-center">{{ partial('action_button',[
                    'action' : url('admin/delete/'~user['id']),
                    'type' : 'btn btn-danger',
                    'name' : 'Suspend'])
                }}
            </td>
        </tr>
    {% endfor %}
</table>