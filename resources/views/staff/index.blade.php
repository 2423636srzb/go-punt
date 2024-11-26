@extends('layout.layout')

@php
$title = 'Staff List';
$subTitle = 'Staff List';
@endphp
<style>
    
    .checkbox-group {
    display: flex;
    flex-wrap: wrap;
    gap: 15px; /* Add spacing between items */
}
.checkbox-group .checkbox-item {
    display: flex;
    align-items: center;
}
.checkbox-group .checkbox-item input {
    margin-right: 8px; /* Add space between checkbox and label */
}

</style>
@section('content')

<div class="card h-100 p-0 radius-12">
    <div class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center flex-wrap gap-3 justify-content-between">
        <div class="d-flex align-items-center flex-wrap gap-3">
            <span class="text-md fw-medium text-secondary-light mb-0">Show</span>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>1</option>
                <option>2</option>
                <option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
                <option>7</option>
                <option>8</option>
                <option>9</option>
                <option>10</option>
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px">
                <option>Status</option>
                <option>Active</option>
                <option>Inactive</option>
            </select>
        </div>
        <a href="#" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <iconify-icon icon="ic:baseline-plus" class="icon text-xl line-height-1"></iconify-icon>
            Add New User
        </a>
    </div>
    <div class="card-body p-24">
        <div class="table-responsive scroll-sm">
            <table class="table bordered-table sm-table mb-0">
                <thead>
                    <tr>
                        <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                </div>
                                S.L
                            </div>
                        </th>
                        <th scope="col">Join Date</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Designation</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="SL">
                                </div>
                                01
                            </div>
                        </td>
                        <td>{{$admin->created_at}}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{$admin->username}}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-md mb-0 fw-normal text-secondary-light">{{$admin->email}}</span></td>
                        <td>Manager</td>
                        <td class="text-center">
                            <span class="bg-success-focus text-success-600 border border-success-main px-24 py-4 radius-4 fw-medium text-sm">Active</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <button type="button" class="bg-info-focus bg-hover-info-200 text-info-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle">
                                    <iconify-icon icon="majesticons:eye-line" class="icon text-xl"></iconify-icon>
                                </button>
                                <button 
                                type="button" 
                                class="edit-btn bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                data-bs-toggle="modal" 
                                data-bs-target="#updateUserModal"
                                data-id="{{ $admin->id }}"
                                data-name="{{ $admin->username }}"
                                data-email="{{ $admin->email }}"
                                data-permissions="{{ $admin->permissions->map(fn($p) => ['id' => $p->id, 'name' => $p->name])->toJson() }}">
                                <iconify-icon icon="lucide:edit" class="menu-icon"></iconify-icon>
                            </button>
                        
                            <form method="POST" action="{{ route('admin.staff.delete', $admin->id) }}" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" 
                                        class="remove-item-btn bg-danger-focus bg-hover-danger-200 text-danger-600 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle delete-btn">
                                    <iconify-icon icon="fluent:delete-24-regular" class="menu-icon"></iconify-icon>
                                </button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
            <span>Showing 1 to 10 of 12 entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-left" class=""></iconify-icon>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md bg-primary-600 text-white" href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px" href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">5</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-neutral-300 text-secondary-light fw-semibold radius-8 border-0 d-flex align-items-center justify-content-center h-32-px w-32-px text-md" href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-right" class=""></iconify-icon>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog model-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="addUserForm" method="POST" action="{{ route('admin.staff.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                    </div>
            
                    <!-- Permissions Section -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Permissions:</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-4 d-flex align-items-center">
                                    <input type="checkbox" 
                                           id="permission_{{ $permission->id }}" 
                                           name="permissions[]" 
                                           value="{{ $permission->name }}" 
                                           class="form-check-input me-2">
                                    <label for="permission_{{ $permission->id }}" class="form-check-label">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form> 
        </div>
    </div>
</div>



<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog model-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateUserModalLabel">Update Admin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateUserForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="update_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="update_name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="update_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="update_email" name="email" required>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="update_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="update_password" name="password" placeholder="Leave blank to keep current password">
                        </div>
                    </div>
            
                    <!-- Permissions Section -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Permissions:</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-4 d-flex align-items-center">
                                <input 
                                    type="checkbox" 
                                    id="update_permission_{{ $permission->id }}" 
                                    name="permissions[]" 
                                    value="{{ $permission->name }}" 
                                    class="form-check-input me-2">
                                <label for="update_permission_{{ $permission->id }}" class="form-check-label">
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form> 
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const updateForm = document.getElementById('updateUserForm');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const permissions = JSON.parse(button.getAttribute('data-permissions'));

            // Set modal fields
            document.getElementById('update_name').value = name;
            document.getElementById('update_email').value = email;

            // Reset all checkboxes
            document.querySelectorAll('#updateUserModal input[name="permissions[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });

            // Check relevant permissions
            permissions.forEach(permission => {
                const checkbox = document.querySelector(`#update_permission_${permission.id}`);
                if (checkbox) checkbox.checked = true;
            });

            // Update the form action URL
            updateForm.action = `staffSetting/update/${id}`;
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('.delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent form submission
            const form = button.closest('form');

            if (confirm('Are you sure you want to delete this admin?')) {
                form.submit(); // Submit the form if confirmed
            }
        });
    });
});





// $('#addUserForm').submit(function (e) {
//     e.preventDefault();

//     let formData = $(this).serialize();
//     let url = $(this).data('url'); // Fetch the correct URL

//     $.ajax({
//         url: url, // Ensure this matches the POST route
//         type: 'POST',
//         data: formData,
//         headers: {
//             'X-CSRF-TOKEN': $('input[name="_token"]').val(), // Include CSRF token
//         },
//         success: function (response) {
//             alert(response.message); // Success message
//             $('#addUserForm')[0].reset(); // Clear form
//             $('#addUserModal').modal('hide'); // Close modal
//         },
//         error: function (xhr) {
//             alert('An error occurred.'); // Handle errors
//         },
//     });
// });



</script>
@endsection

