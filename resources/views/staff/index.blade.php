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
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px" id="showSelect">
                <option>10</option>
                <option>20</option>
                <option>30</option>
                <option>50</option>
                <option>100</option>
              
            </select>
            <form class="navbar-search">
                <input type="text" class="bg-base h-40-px w-auto" name="search" id="searchInput" placeholder="Search">
                <iconify-icon icon="ion:search-outline" class="icon"></iconify-icon>
            </form>
            <select class="form-select form-select-sm w-auto ps-12 py-6 radius-12 h-40-px" id="statusSelect">
                <option>Status</option>
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
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
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone No</th>
                        <th scope="col">Join Date</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @foreach ($admins as $admin)
                    <tr class="admin-row" data-status="{{ $admin->user_status }}">
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
                        <td class="text-center">
                            <span class="px-24 py-4 radius-4 fw-medium text-sm {{ $admin->user_status == 'active' ? 'bg-success-focus text-success-600' : 'bg-danger-focus text-danger-600' }}">
                                {{ ucfirst($admin->user_status) }}
                            </span>
                        </td>
                        <td class="text-center">
                            <!-- Add Action Buttons Here -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-24">
            <span id="entriesInfo"></span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center" id="pagination"></ul>
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const statusSelect = document.getElementById("statusSelect");
        const showSelect = document.getElementById("showSelect");
        const tableBody = document.getElementById("tableBody");
        const rowsPerPageOptions = showSelect.options;
        let rowsPerPage = parseInt(showSelect.value) || 10;

        // Store all rows initially
        const allRows = Array.from(tableBody.getElementsByClassName("admin-row"));
        
        // Function to filter and render the table
        function filterTable() {
            const searchQuery = searchInput.value.toLowerCase();
            const selectedStatus = statusSelect.value.toLowerCase();
            let filteredRows = allRows;

            // If search input is not empty, filter rows by search query
            if (searchQuery !== "") {
                filteredRows = filteredRows.filter(row => {
                    const name = row.cells[0].textContent.toLowerCase();
                    const email = row.cells[1].textContent.toLowerCase();
                    const phone = row.cells[2].textContent.toLowerCase();
                    const status = row.getAttribute("data-status");

                    const matchesSearch = name.includes(searchQuery) || email.includes(searchQuery) || phone.includes(searchQuery);
                    const matchesStatus = selectedStatus === "status" || selectedStatus === status;

                    return matchesSearch && matchesStatus;
                });
            }

            // If status is selected, filter rows by status
            if (selectedStatus !== "status" && selectedStatus !== "") {
                filteredRows = filteredRows.filter(row => row.getAttribute("data-status") === selectedStatus);
            }

            // Handle pagination based on rowsPerPage
            const totalRows = filteredRows.length;
            const startIndex = 0; // Adjust based on pagination logic
            const endIndex = startIndex + rowsPerPage;

            // Clear the table and append the filtered rows
            tableBody.innerHTML = "";
            filteredRows.slice(startIndex, endIndex).forEach(row => {
                tableBody.appendChild(row);
            });

            // Update the entries info (optional)
            document.getElementById("entriesInfo").textContent = `${filteredRows.length} entries found`;
        }

        // Event listeners for input changes
        searchInput.addEventListener("input", filterTable);
        statusSelect.addEventListener("change", filterTable);
        showSelect.addEventListener("change", function() {
            rowsPerPage = parseInt(this.value);
            filterTable(); // Reapply filters when page size changes
        });

        // Initial table filter application
        filterTable();
    });
</script>


@endsection

