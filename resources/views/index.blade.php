@extends('layouts.master')

@section('main-content')

    <div class="mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       <h4>User list</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Username</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->username }}</td>
                                            <td>{{ $user->service->name ?? 'None' }}</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm editUser" data-id="{{ $user->id }}">Edit</button>
                                                <button class="btn btn-danger btn-sm deleteUser" data-id="{{ $user->id }}">Delete</button>
                                                <button class="btn btn-info btn-sm checkMatch" data-id="{{ $user->id }}">Check Match</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="card">
                    <div class="card-header">
                        <h4>Create User</h4>
                    </div>
                    <div class="card-body">
                        <form id="createUser">
                            @csrf
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="service_id">Select Service (Optional):</label>
                                <select class="form-control" id="service_id" name="service_id">
                                    <option value="">Select a Service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create User</button>
                        </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>


<!-- Edit User Modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="editUserForm">
                @csrf
                <input type="hidden" id="editUserId" name="id">
                <div class="form-group">
                    <label for="editName">Username:</label>
                    <input type="text" id="editName" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="editService">Select Service (Optional):</label>
                    <select id="editService" name="service_id" class="form-control">
                        <option value="">Select a Service (Optional)</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update User</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
           // Create User
            $('#createUser').on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    url: '/users/store',
                    method: 'get',
                    data: $(this).serialize(),
                    success: function (response) {
                        if (response.success) {
                            // alert('User created successfully');
                            toastr.success('User created successfully')

                        }else{
                            toastr.error('User not created')
                        }
                        location.reload();
                    }
                });
            });

            //Edit User
            $(".editUser").on('click',function(){
                let userId = $(this).data('id');

                $.ajax({
                    type: "GET",
                    url: `/users/${userId}/edit`,
                    success: function (response) {
                        // Populate the form with the user data
                        $('#editUserId').val(response.id);
                        $('#editName').val(response.username);
                        $('#editService').val(response.service_id);
                        // Show the modal
                        $('#exampleModal').modal('show');
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });

            });

            //User Update Form
            $("#editUserForm").on('submit',function(){
                // e.preventDefault();
                let userId = $('#editUserId').val();

                $.ajax({
                    type: "get",
                    url: `/users/update/${userId}`,
                    data: $('#editUserForm').serialize(),
                    success: function (response) {
                        if (response.success) {
                            // alert('User created successfully');
                            toastr.success('User Updated successfully')

                        }else{
                            toastr.error('User not Updated')
                        }
                        location.reload();
                    }
                });
            })

            //Delete User
            $('.deleteUser').on('click', function () {
            if (!confirm('Are you sure you want to delete this user?')) {
                return;
            }

            let userId = $(this).data('id');

            $.ajax({
                url: '/users/' + userId,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        toastr.success('User deleted successfully')
                         // Reload the page to update the user list
                    }else{
                        toastr.error('User not deleted')
                    }
                    location.reload();
                }
            });
        });

            // Check Matching Service
        $('.checkMatch').on('click', function () {
            let userId = $(this).data('id');

            $.ajax({
                url: '/check-match/' + userId,
                method: 'GET',
                success: function (response) {
                    if (response.matched) {
                        // alert('Matched: ' + response.message);
                        toastr.success('The Value is Matched')
                    } else {
                        // alert('Not Matched: ' + response.message);
                        toastr.error('The Value is Not Matched')
                    }
                }
            });
        });
    });

    </script>
@endpush
