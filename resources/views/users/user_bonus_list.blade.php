@extends('layout.layout')

@php
    $title = 'Users Bonus List';
    $subTitle = 'Users Bonus List';

@endphp
<style>
    #dt-length-0{
        margin-right: 10px;
    }
</style>
@section('content')
    <div class="card h-100 p-0 radius-12">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="card-body p-24">
            <div class="table-responsive scroll-sm">
                <table class="table bordered-table sm-table mb-0" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Bonus</th>
                            <th scope="col">Granted Date</th>
                            <th scope="col">Granted By</th>
                            <th scope="col">PlateForm</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dedicated TO</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bonuses as $bonus)
                        <tr>
                            <td>{{ $bonus->user_name }}</td>
                            <td>{{ $bonus->bonus }}</td>
                            <td>{{ date('Y-m-d', strtotime($bonus->granted_date)) }}</td>
                            <td>{{ $bonus->granted_by }}</td>
                            <td>{{ $bonus->platform_name }}</td>
                            <td class="{{ $bonus->redem ? 'text-success' : 'text-danger' }}">
                                {{ $bonus->redem ? 'Redeemed' : 'Pending' }}
                            </td>
                            <td>{{ $bonus->dedicated_game_name ?? ' ' }}</td>
                            <td>
                              @if(!$bonus->redem == "Redeem")
                                    <!-- Show Redeem button only if bonus is pending -->
                                    <button class="btn btn-primary btn-xs" style="font-size: 12px; padding: 5px 10px;"> <a href="javascript:void(0)"
                                    class="redeem-btn"
                                    data-bonus-id="{{ $bonus->id }}"
                                    data-bonus="{{ $bonus->bonus }}"
                                    data-dedicated-game="{{ $bonus->dedicated_game_name ?? '' }}">
                                    Redeem
                                    </a></button>
                                @else
                                    <!-- Optionally, show a disabled button or nothing -->
                                    <button class="btn btn-secondary btn-xs"style="font-size: 12px; padding: 5px 10px;" disabled>Redeemed</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

            </table>
        </div>


    </div>
    </div>
       <!-- Bonus Modal -->
<!-- Bonus Modal -->
<div class="modal fade" id="bonusModal" tabindex="-1" aria-labelledby="bonusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="bonusModalLabel">Redeem Your Bonus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Display Total Bonus -->
                <p class="text-gray-700 text-center mb-3">
                 Bonus: <span class="font-semibold text-primary" id="selectedBonus"></span>
                </p>
                <!-- Game Platform Dropdown -->
                <label for="gamePlatform" class="form-label">Select Platform:</label>
                <select id="gamePlatform" class="form-select">
                    <!-- Options will be injected here -->
                </select>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="assignBonus()">Redeem</button>
                {{-- <button type="button" class="btn btn-success" onclick="saveBonus()">Save</button> --}}
            </div>
        </div>
    </div>
</div>

<script>
      // Preload all user accounts into a JavaScript variable.
      const userAccounts = @json($userAccounts);


      document.addEventListener('DOMContentLoaded', function() {
    // Listen for clicks on any element with class 'redeem-btn'
    document.querySelectorAll('.redeem-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            // Retrieve the dedicated game name from data attribute (if any)
            let dedicatedGame = this.getAttribute('data-dedicated-game').trim();
            // (Optional) Retrieve the bonus id if needed
            let bonusId = this.getAttribute('data-bonus-id');
            let bonusValue = this.getAttribute('data-bonus');

            // Get the select element from the modal
            let select = document.getElementById('gamePlatform');
            document.getElementById('selectedBonus').innerText = bonusValue;
            // Clear any existing options
            select.innerHTML = '<option value="">-- Select Platform --</option>';

            if (dedicatedGame !== '') {
                // If a dedicated game exists, populate dropdown with just that option.
                // Optionally, if you need the game id and it's not just a name,
                // you might pass it as another data attribute (e.g., data-dedicated-game-id)
                // For this example, we'll assume the dedicated game is unique.
                // We'll search in userAccounts for the account with this name.
                let dedicatedAccount = userAccounts.find(acc => acc.game_name === dedicatedGame);
                if (dedicatedAccount) {
                    select.innerHTML += `<option value="${dedicatedAccount.id}" data-user-name="${dedicatedAccount.game_name}">${dedicatedAccount.game_name}</option>`;
                } else {
                    // If dedicated game name not found in userAccounts, show as plain option.
                    select.innerHTML += `<option value="dedicated">${dedicatedGame}</option>`;
                }
            } else {
                // No dedicated game: populate dropdown with all available game platforms.
                userAccounts.forEach(function(account) {
                    select.innerHTML += `<option value="${account.id}" data-user-name="${account.game_name}">${account.game_name}</option>`;
                });
            }

            // Optionally, store the bonus id in the modal element or in a hidden input
            // so you know which bonus you're redeeming.
            document.getElementById('bonusModal').setAttribute('data-bonus-id', bonusId);

            // Finally, show the modal
            let bonusModal = new bootstrap.Modal(document.getElementById("bonusModal"));
            bonusModal.show();
        });
    });
});
       // Open Modal Function (Bootstrap automatically handles this)
function openBonusModal() {
    let bonusModal = new bootstrap.Modal(document.getElementById("bonusModal"));
    bonusModal.show();
}

function assignBonus() {
    let gamePlatformDropdown = document.getElementById("gamePlatform");
    let userAccountId = gamePlatformDropdown.value;
    let gamePlatformName = gamePlatformDropdown.options[gamePlatformDropdown.selectedIndex]?.dataset.userName;

    // Retrieve the bonus ID stored on the modal element
    let bonusId = document.getElementById('bonusModal').getAttribute('data-bonus-id');

    if (!userAccountId) {
        alert("Please select a game platform!");
        return;
    }
    if (!bonusId) {
        alert("Bonus record not specified!");
        return;
    }

    fetch("{{ route('admin.assign.bonus') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            bonus_id: bonusId,  // Pass bonus id to update specific record
            user_account_id: userAccountId,
            game_name: gamePlatformName,
            // Remove totalBonus if not needed per record update.
        })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        let modal = bootstrap.Modal.getInstance(document.getElementById("bonusModal"));
        modal.hide(); // Close modal after success
        location.reload();
    })
    .catch(error => console.error('Error:', error));
}


// // Save Bonus (Example function)
// function saveBonus() {
//     alert("Bonus saved successfully!");
//     let modal = bootstrap.Modal.getInstance(document.getElementById("bonusModal"));
//     modal.hide(); // Close modal after saving
// }
</script>

@endsection

