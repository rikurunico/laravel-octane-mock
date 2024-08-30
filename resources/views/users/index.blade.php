<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">User Management</h2>
        <button class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal" onclick="openUserModal()">Add
            User</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="userTable">
                <!-- User data will be loaded here -->
            </tbody>
        </table>
    </div>

    <!-- User Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="userForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Add User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="userId">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            fetchUsers();

            // Handle form submission
            $('#userForm').submit(function(e) {
                e.preventDefault();
                const userId = $('#userId').val();
                const url = userId ? `/user/${userId}` : '/user';
                const method = userId ? 'PUT' : 'POST';
                const data = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    password: $('#password').val(),
                    _method: method,
                    _token: '{{ csrf_token() }}',
                };

                $.ajax({
                    url: url,
                    type: method,
                    data: data,
                    success: function(response) {
                        $('#userModal').modal('hide');
                        fetchUsers();
                    },
                    error: function(xhr) {
                        alert('Something went wrong!');
                    }
                });
            });
        });

        // Fetch users
        function fetchUsers() {
            $.get('/user', function(users) {
                let userTable = '';
                users.forEach(user => {
                    userTable += `
                    <tr>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editUser(${user.id})">Edit</button>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser(${user.id})">Delete</button>
                        </td>
                    </tr>
                `;
                });
                $('#userTable').html(userTable);
            });
        }

        // Open modal for adding/editing user
        function openUserModal() {
            $('#userId').val('');
            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#userModalLabel').text('Add User');
        }

        // Edit user
        function editUser(id) {
            $.get(`/user/${id}`, function(user) {
                $('#userId').val(user.id);
                $('#name').val(user.name);
                $('#email').val(user.email);
                $('#password').val('');
                $('#userModalLabel').text('Edit User');
                $('#userModal').modal('show');
            });
        }

        // Delete user
        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: `/user/${id}`,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function() {
                        fetchUsers();
                    },
                    error: function() {
                        alert('Failed to delete the user.');
                    }
                });
            }
        }
    </script>

</body>

</html>
