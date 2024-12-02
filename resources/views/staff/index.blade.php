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
            <table class="table bordered-table sm-table mb-0" id="dataTable">
                <thead>
                    <tr>
                        {{-- <th scope="col">
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border input-form-dark" type="checkbox" name="checkbox" id="selectAll">
                                </div>
                            </div>
                        </th> --}}
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Join Date</th>
                        {{-- <th scope="col">Designation</th> --}}
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        {{-- <td>
                            <div class="d-flex align-items-center gap-10">
                                <div class="form-check style-check d-flex align-items-center">
                                    <input class="form-check-input radius-4 border border-neutral-400" type="checkbox" name="checkbox" id="SL">
                                </div>
                            </div>
                        </td> --}}
                       
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('assets/images/users/avatar-large-square.jpg') }}" alt="" class="w-40-px h-40-px rounded-circle flex-shrink-0 me-12 overflow-hidden">
                                <div class="flex-grow-1">
                                    <span class="text-md mb-0 fw-normal text-secondary-light">{{$admin->username}}</span>
                                </div>
                            </div>
                        </td>
                        <td><span class="text-md mb-0 fw-normal text-secondary-light">{{$admin->email}}</span></td>
                        <td><span class="text-md mb-0 fw-normal text-secondary-light">{{$admin->phone_number}}</span></td>
                        <td>{{$admin->created_at}}</td>
                        {{-- <td>Manager</td> --}}
                        @php
                        // Dynamically determine the status class and text
                        if ($admin->user_status == 'active') {
                            $statusClass = 'bg-success-focus text-success-600 border border-success-main';
                            $statusText = 'Active';
                        } else {
                            $statusClass = 'bg-danger-focus text-danger-600 border border-danger-main';
                            $statusText = 'Inactive';
                        }
                    @endphp
                        <td class="text-center">
                            <span class="{{ $statusClass }} px-24 py-4 radius-4 fw-medium text-sm">
                                {{ $statusText }}
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center gap-10 justify-content-center">
                                <div class="form-switch switch-success d-flex align-items-center gap-3">
                                    <input class="form-check-input switch-input" type="checkbox"
                                           data-id="{{ $admin->id }}" role="switch"
                                           @if ($admin->user_status == 'active') checked @endif>
                                </div>
                                
                                <button 
                                type="button" 
                                class="edit-btn bg-success-focus text-success-600 bg-hover-success-200 fw-medium w-40-px h-40-px d-flex justify-content-center align-items-center rounded-circle"
                                data-bs-toggle="modal" 
                                data-bs-target="#updateUserModal"
                                data-id="{{ $admin->id }}"
                                data-name="{{ $admin->username }}"
                                data-email="{{ $admin->email }}"
                                data-number="{{ $admin->phone_number }}"
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
            <span id="entriesInfo"></span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center" id="pagination">
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
                        <div class="mb-3 col-md-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="phone-number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="" required>
                        </div>
                    </div>
            
                    <!-- Permissions Section -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Permissions:</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                                <div class="col-md-12 d-flex align-items-center">
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
                        <div class="mb-3 col-md-12">
                            <label for="update_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="update_name" name="name" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="update_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="update_email" name="email" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="update_phone" class="form-label">Phone No</label>
                            <input type="text" class="form-control" id="update_phone" name="phone_number" required>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label for="update_password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="update_password" name="password" placeholder="Leave blank to keep current password">
                        </div>
                    </div>
            
                    <!-- Permissions Section -->
                    <div class="mb-3">
                        <label for="permissions" class="form-label">Permissions:</label>
                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-12 d-flex align-items-center">
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
@section('js')
    <script src="{{ asset('assets/js/lib/') }}/confirmation-modal.min.js"></script>

    <script>
       $(document).ready(function() {
    // Disable user
    $('.switch-input').on('click', function() {
        const userId = $(this).data('id');
        var curr_obj = $(this);
        var status = '';
        if ($(this).is(":checked")) {
            status = 'enable';
        } else {
            status = 'disable';
        }

        // Confirmation Modal
        confirmationModal.show({
            closeIcon: true,
            message: 'Are you sure you want to ' + status + ' this user?',
            title: 'User Status',
            no: {
                class: 'btn btn-danger',
                text: 'No'
            },
            yes: {
                class: 'btn btn-success',
                text: 'Yes'
            }
        }).then(() => modalClosed(true))
        .catch(() => modalClosed(false));

        const modalClosed = isYes => {
            if (isYes) {
                $.ajax({
                    url: `{{ url('admin/users/updateUserStatus/') }}` + "/" + userId + "/" + status,
                    type: 'PATCH', // Use PATCH to update the status
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Show success toast
                        showToast('User ' + status + ' successfully.', 'success');

                        // Update the status in the frontend
                        if (status == 'enable') {
                            $('#user-status-' + userId).removeClass('text-danger-main bg-danger-focus');
                            $('#user-status-' + userId).addClass('text-success-main bg-success-focus');
                            $('#user-status-' + userId).html('Active');
                        } else {
                            $('#user-status-' + userId).addClass('text-danger-main bg-danger-focus');
                            $('#user-status-' + userId).removeClass('text-success-main bg-success-focus');
                            $('#user-status-' + userId).html('Inactive');
                        }
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error and show error toast
                        showToast('Error ' + status + ' user.', 'error');
                        curr_obj.prop('checked', !curr_obj.is(":checked"));
                    }
                });
            } else {
                // Reset checkbox state if the modal is closed without confirming
                curr_obj.prop('checked', !curr_obj.is(":checked"));
            }
        };
    });
});

    </script>
@endsection
 <script>
        // Variables for managing table and pagination
        const rowsPerPage = 5;  // Number of rows per page
        let currentPage = 1;    // Initial page

        // Function to update the entries info dynamically
        function updateEntriesInfo() {
            const table = document.getElementById("dataTable");
            const totalRows = table.rows.length - 1; // Exclude header row
            const startIndex = (currentPage - 1) * rowsPerPage + 1;
            const endIndex = Math.min(currentPage * rowsPerPage, totalRows);
            
            const entriesInfo = document.getElementById("entriesInfo");
            entriesInfo.textContent = `Showing ${startIndex} to ${endIndex} of ${totalRows} entries`;
        }

        // Function to generate pagination links dynamically
        function generatePagination() {
            const table = document.getElementById("dataTable");
            const totalRows = table.rows.length - 1; // Exclude header row
            const totalPages = Math.ceil(totalRows / rowsPerPage);
            const pagination = document.getElementById("pagination");

            // Clear existing pagination links
            pagination.innerHTML = '';

            // Add "Previous" button
            const prevPage = document.createElement("li");
            prevPage.classList.add("page-item");
            prevPage.innerHTML = `<a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage - 1})">&laquo;</a>`;
            if (currentPage === 1) prevPage.classList.add("disabled");
            pagination.appendChild(prevPage);

            // Generate page number buttons
            for (let i = 1; i <= totalPages; i++) {
                const pageItem = document.createElement("li");
                pageItem.classList.add("page-item");
                const pageLink = document.createElement("a");
                pageLink.classList.add("page-link");
                pageLink.href = "javascript:void(0)";
                pageLink.textContent = i;
                pageLink.onclick = () => changePage(i);

                if (i === currentPage) {
                    pageLink.classList.add("bg-primary-600", "text-white");
                } else {
                    pageLink.classList.add("bg-neutral-300", "text-secondary-light");
                }

                pageItem.appendChild(pageLink);
                pagination.appendChild(pageItem);
            }

            // Add "Next" button
            const nextPage = document.createElement("li");
            nextPage.classList.add("page-item");
            nextPage.innerHTML = `<a class="page-link" href="javascript:void(0)" onclick="changePage(${currentPage + 1})">&raquo;</a>`;
            if (currentPage === totalPages) nextPage.classList.add("disabled");
            pagination.appendChild(nextPage);
        }

        // Change the page number and update the table and pagination
        function changePage(page) {
            const table = document.getElementById("dataTable");
            const totalRows = table.rows.length - 1; // Exclude header row

            // Ensure the page number is within the valid range
            if (page < 1 || page > Math.ceil(totalRows / rowsPerPage)) return;

            currentPage = page;
            updateEntriesInfo();
            generatePagination();
            displayPageRows();
        }

        // Function to display only the rows for the current page
        function displayPageRows() {
            const table = document.getElementById("dataTable");
            const rows = table.querySelectorAll("tbody tr");

            // Hide all rows first
            rows.forEach(row => row.style.display = 'none');

            // Display the rows for the current page
            const startIndex = (currentPage - 1) * rowsPerPage;
            const endIndex = Math.min(currentPage * rowsPerPage, rows.length);

            for (let i = startIndex; i < endIndex; i++) {
                rows[i].style.display = 'table-row';
            }
        }

        // Initialize the table, pagination, and entries info
        function initialize() {
            updateEntriesInfo();
            generatePagination();
            displayPageRows();
        }

        // Call the initialize function on page load
        initialize();
    </script>

<script>
    // Function to update the entries info dynamically
    function updateEntriesInfo(page = 1, rowsPerPage = 10) {
        const table = document.getElementById("dataTable");
        const totalRows = table.rows.length - 1; // Exclude header row
        const startIndex = (page - 1) * rowsPerPage + 1;
        const endIndex = Math.min(page * rowsPerPage, totalRows);
        
        const entriesInfo = document.getElementById("entriesInfo");
        entriesInfo.textContent = `Showing ${startIndex} to ${endIndex} of ${totalRows} entries`;
    }

    // Initialize by calling the function with the default page and rows per page
    updateEntriesInfo();
</script>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const editButtons = document.querySelectorAll('.edit-btn');
    const updateForm = document.getElementById('updateUserForm');

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone_number = button.getAttribute('data-number');
            const permissions = JSON.parse(button.getAttribute('data-permissions'));

            // Set modal fields
            document.getElementById('update_name').value = name;
            document.getElementById('update_email').value = email;
            document.getElementById('update_phone').value = phone_number;

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

