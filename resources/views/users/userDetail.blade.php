@extends('layout.layout')

@php
$title = 'User Detail';
$subTitle = 'User Detail';
@endphp

@section('content')

<style>
    .sortable-list {
        list-style: none;
        margin: 0;
        min-height: 20px;
        padding: 0px;
    }

    .sortable-item {
        background-color: #fff;
        border: 1px solid #ddd;
        display: block;
        margin-bottom: -1px;
        padding: 10px;
        cursor: move;
        position: relative;
        padding-left: 30px;
    }

    .icon-drag {
        color: #ccc;
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

    .sortable-item-input {
        visibility: hidden;
        pointer-events: none;
        position: absolute;
    }

    .placeholder {
        border: 1px dashed #666;
        height: 45px;
        margin-bottom: 5px;
    }

    .fixed-panel {
        max-height: 500px;
        overflow-y: none;
        padding-bottom: 1px;
    }

    .custom-scrollbar::-webkit-scrollbar {
        width: 7px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {

        border-radius: 5px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .custom-placeholder {
        background-color: #e9ecef;
        /* Light gray */
        border: 2px dashed #28a745;
        /* Green dashed border */
        max-height: 10px !important;
        height: 10px !important;
        min-height: 10px !important;
        /* Adjust height as needed */
        opacity: 0.5;
        border-radius: 4px;
        padding: 20px !important;
        margin: 10px 0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
    }

    .pull-right {
        float: right;
    }
</style>

<div class="row gy-4">
    <div class="col-md-12">
        <div class="card h-100 p-0">
            <div
                class="card-header border-bottom bg-base py-16 px-24 d-flex align-items-center justify-content-between">
                <h6 class="text-lg fw-semibold mb-0">Assign Game to {{ $user->name }}</h6>
            </div>

            <div class="container">

                <span name="el_validationErrorFields"></span>
                <br />

                <!--  Example: 1  -->
                <input type="text" name="page_contents[]" data-options='{{ $games }}' data-selected='{{ $userJson }}'
                    data-field-title="<i class='fa fa-folder-open'></i> Available Games"
                    data-selected-title="<i class='fa fa-star'></i> Assigned Games" class="dragableMultiselect">
                <!--  END  -->
            </div>
        </div>
    </div>

</div>

@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sortable/0.9.13/jquery-sortable.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>


<script>
    function moveSelectedItems() {
        const sourceList = document.getElementById("sourceList");
        const destinationList = document.getElementById("destinationList");

        // Select all checked items in the source list
        const selectedItems = document.querySelectorAll("#sourceList .item-checkbox:checked");

        selectedItems.forEach(checkbox => {
            const listItem = checkbox.closest("li"); // Get the parent <li> of the checkbox
            destinationList.appendChild(listItem);   // Move the <li> to the destination list
            checkbox.checked = false;                // Uncheck the item after moving
        });

        // Reset "Select All" checkbox if all items are moved
        if (!sourceList.querySelector(".item-checkbox")) {
            document.getElementById("selectAll").checked = false;
        }
    }
    $(function () {
        let mainWrapper = '.dragSortableItems',
            in_available_fields = '.in_available_fields',
            selectedDropzone = '.selectedDropzone',
            input_name = 'name';

        // On ready
        $(document).ready(function () {

            const dragableMultiselect = $('.dragableMultiselect');
            dragableMultiselect.length && dragableMultiselect.each((index, value) => {
                const $this = $(value);

                const available_fields = $.extend({}, $this.data('options'));
                const selected_fields = $.extend([], $this.data('selected'));

                const $input_name = $this.attr(input_name);
                let fieldTitle = $this.data('field-title');
                let selectedTitle = $this.data('selected-title');

                let html = '<div class="row dragSortableItems dragSortableItem_' + index + '">\
                    <div class="col-sm-6">\
                      <div class="card">\
                        <div class="card-header">' + fieldTitle + '\
                            <label class="pull-right">\
                                <input type="checkbox" id="selectAll" class="form-check-input" /> Select All\
                                <button id="moveSelected" onclick="moveSelectedItems()" class="btn btn-sm rounded-pill btn-info-100 text-info-600 radius-8 px-10 py-4">Move Selected</button>\
                            </label>\
                            </div>\
                        <div class="card-body">\
                          <ul id="sourceList" class="in_available_fields custom-scrollbar sortable-list fixed-panel ui-sortable"></ul>\
                        </div>\
                      </div>\
                    </div>\
                    <div class="col-sm-6">\
                      <div class="card primaryPanel">\
                        <div class="card-header">' + selectedTitle + '</div>\
                        <div class="card-body">\
                          <div class="alert alert-warning small text-center mb-0">No Fields Selected</div>\
                          <ul class="in_primary_fields sortable-list selectedDropzone fixed-panel" id="destinationList"></ul>\
                        </div>\
                      </div>\
                    </div>\
                  </div>';
                $this.replaceWith(html);
                $dragSortableItem = $('.dragSortableItem_' + index);

                let $mainWrapper = $dragSortableItem.closest(mainWrapper),
                    $in_available_fields = $mainWrapper.find(in_available_fields),
                    $selectedDropzone = $mainWrapper.find(selectedDropzone);


                //console.log(available_fields, selected_fields, $mainWrapper, $in_available_fields, $selectedDropzone, $input_name);

                Object.keys(available_fields).forEach(function (key) {
                    var item = '<li class="sortable-item allowPrimary sortable-item-' + key + '" data-fid="' + key + '">'
                        + '<input type="checkbox" class="item-checkbox form-check-input me-12">'
                        + '<span class="icon-drag fas fa-grip-vertical mr-2"></span>'
                        + '<input type="checkbox" name="' + $input_name + '" class="sortable-item-input"/>'
                        + '<img src="' + available_fields[key]['logo_url'] + '" alt="" width="50" /> &nbsp; '
                        + available_fields[key]['name']
                        + '</li>';
                    $in_available_fields.append(item);
                });

                selected_fields.map(function (index) {
                    var item = $in_available_fields.find('.sortable-item-' + index);
                    item.find('.sortable-item-input').prop('checked', true);
                    $selectedDropzone.append(item);
                });

                checkFields($mainWrapper);

                // Set up our dropzone
                $in_available_fields.sortable({
                    connectWith: '.sortable-list',
                    placeholder: 'custom-placeholder',
                    start: function (event, ui) {
                        ui.placeholder.height(ui.item.height());
                        if (!$(ui.item).hasClass("allowPrimary")) {
                            $mainWrapper.find(".primaryPanel").removeClass('panel-primary').addClass("panel-danger");
                        }
                        checkFields($mainWrapper)
                    },
                    receive: function (event, ui) {
                        $(ui.item).find('.sortable-item-input').prop('checked', false);
                    },
                    stop: function (event, ui) {
                        if (!$(ui.item).hasClass("allowPrimary")) {
                            $mainWrapper.find(".primaryPanel").removeClass("panel-danger").addClass('panel-primary');
                        }
                    },
                    change: function (event, ui) {
                        checkFields($mainWrapper);
                    },
                    update: function (event, ui) {
                        checkFields($mainWrapper);
                    },
                    out: function (event, ui) {
                        checkFields($mainWrapper);
                    }
                }).disableSelection();

                // Enable dropzone for primary fields
                $selectedDropzone.sortable({
                    connectWith: '.sortable-list',
                    placeholder: 'custom-placeholder',
                    receive: function (event, ui) {
                        // If we dont allow primary fields here, cancel
                        if (!$(ui.item).hasClass("allowPrimary")) {
                            $(ui.placeholder).css('display', 'none');
                            $(ui.sender).sortable("cancel");
                        } else {
                            $(ui.item).find('.sortable-item-input').prop('checked', true);
                        }
                    },
                    over: function (event, ui) {
                        if (!$(ui.item).hasClass("allowPrimary")) {
                            $(ui.placeholder).css('display', 'none');
                        } else {
                            $(ui.placeholder).css('display', '');
                        }
                    },
                    start: function (event, ui) {
                        checkFields($mainWrapper)
                    },
                    change: function (event, ui) {
                        checkFields($mainWrapper);
                    },
                    update: function (event, ui) {
                        checkFields($mainWrapper);

                        let assignedGameIds = $("#destinationList").sortable("toArray", { attribute: "data-fid" });
                        let availableGameIds = $("#sourceList").sortable("toArray", { attribute: "data-fid" });

                        // Send AJAX request to update the assigned games in the database
                        $.ajax({
                            url: '{{ route("admin.updateAssignedGames", $user->id) }}',
                            method: 'POST',
                            data: {
                                assigned_game_ids: assignedGameIds,
                                available_game_ids: availableGameIds,
                                _token: '{{ csrf_token() }}' // CSRF token for security
                            },
                            success: function (response) {
                                showToast(response.message, 'info'); // Show a success message (optional)
                            },
                            error: function (xhr) {
                                console.error(xhr.responseText); // Handle errors (optional)
                            }
                        });
                    },
                    out: function (event, ui) {
                        checkFields($mainWrapper);
                    }
                }).disableSelection();
            });
            document.getElementById("selectAll").addEventListener("change", function () {
                const checkboxes = document.querySelectorAll("#sourceList .item-checkbox");
                checkboxes.forEach(checkbox => checkbox.checked = this.checked);
            });
        });

        // Checks to see if the fields section has fields selected. If not, shows a placeholder
        function checkFields($this) {
            if ($this.find(selectedDropzone).find('li').length >= 1) {
                $this.find('.primaryPanel').find('.alert').hide();
            } else {
                $this.find('.primaryPanel').find('.alert').show();
            }
        }







    });

</script>
@endsection