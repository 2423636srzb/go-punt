@extends('layout.layout')

@php
    $title = 'Live Matches';
    $subTitle = 'Live Matches';
@endphp

@section('content')

    <div class="card">
        {{-- <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3"> --}}

        <section class="services" id="live" style="margin: 0;">
            {{-- <div class="container mx-auto mb-4 overflow-hidden relative">
                  <div class="flex justify-center items-center transition-transform duration-500 ease-in-out">
                    <h1 class="text-lg font-semibold text-black" style="font-size:30px; text-align:center;">Our Live Matches</h1>
                  </div>
                </div> --}}

            <!-- Buttons for Cricket, Tennis, and Football -->
            <div class="button-container">
                <button class="game-button active" data-game="cricket" onclick="toggleGames('cricket', this)">
                    <img src="{{ asset('assets/images/BD/icons/cricket.gif') }}" alt="Cricket Icon" class="icon" />
                    <span class="game-text">Cricket</span>
                </button>
                <button class="game-button" data-game="tennis" onclick="toggleGames('tennis', this)">
                    <img src="{{ asset('assets/images/BD/icons/tennis.gif') }}" alt="Tennis Icon" class="icon" />
                    <span class="game-text">Tennis</span>
                </button>
                <button class="game-button" data-game="football" onclick="toggleGames('football', this)">
                    <img src="{{ asset('assets/images/BD/icons/football.gif') }}" alt="Football Icon" class="icon" />
                    <span class="game-text">Football</span>
                </button>
            </div>

            <!-- Cricket Container (default) -->
            <div class="container-cricket active mt-4">
                <div class="services__main d-flex flex-wrap justify-content-start" id="cricket-container">
                    @if (count($liveCricket) > 0)
                        @foreach ($liveCricket as $index => $cricket)
                            <div class="services-box border p-3 cricket-item"
                                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                                <a href="" class=" text-black mb-2 w-full block text-center"
                                    style="font-size: 12px; line-height: 20px;">{{ $cricket['Name'] }}</a>
                                <hr class="mb-1">
                                <div class="match-container">
                                    <iframe src="https://live.oldd247.com/sr.php?eventid={{ $cricket['MatchID'] }}"
                                        width="200" height="100" style="border: 1px solid #ccc;"
                                        allowfullscreen></iframe>
                                    <div class="live-button-container">
                                        <a href="{{ Auth::check() ? route('live.stream', ['eventId' => $cricket['MatchID'], 'sportId' => 4, 'channelId' => $cricket['Channel']]) : '#' }}"
                                            onclick="checkLogin(event)">
                                            <button type="submit" class="btn-action btn-live">Live Match</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-100 text-center">
                            <p class="text-black">No match is live</p>
                        </div>
                    @endif
                </div>

                @if (count($liveCricket) > 4)
                    <div class="text-center mt-3">
                        <button class="btn btn-primary seeMoreBtn" data-container="cricket">See More</button>
                    </div>
                @endif
            </div>

            <!-- Tennis Container -->
            <div class="container-tennis mt-4">
                <div class="services__main d-flex flex-wrap justify-content-start" id="tennis-container">
                    @if (count($liveTennis) > 0)
                        @foreach ($liveTennis as $index => $tennis)
                            <div class="services-box border p-3 tennis-item"
                                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                                <a href="" class=" text-black mb-2 w-full block text-center"
                                    style="font-size: 12px; line-height: 20px;">{{ $tennis['Name'] }}</a>
                                <hr class="mb-1">
                                <div class="match-container">
                                    <iframe src="https://live.oldd247.com/sr.php?eventid={{ $tennis['MatchID'] }}"
                                        width="200" height="100" style="border: 1px solid #ccc;"
                                        allowfullscreen></iframe>
                                    <div class="live-button-container">
                                        <a href="{{ Auth::check() ? route('live.stream', ['eventId' => $tennis['MatchID'], 'sportId' => 2, 'channelId' => $tennis['Channel']]) : '#' }}"
                                            onclick="checkLogin(event)">
                                            <button type="submit" class="btn-action btn-live">Live Match</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-100 text-center">
                            <p class="text-black">No match is live</p>
                        </div>
                    @endif
                </div>

                @if (count($liveTennis) > 4)
                    <div class="text-center mt-3">
                        <button class="btn btn-primary seeMoreBtn" data-container="tennis">See More</button>
                    </div>
                @endif
            </div>

            <!-- Football Container -->
            <div class="container-football mt-4">
                <div class="services__main d-flex flex-wrap justify-content-start" id="football-container">
                    @if (count($liveFootball) > 0)
                        @foreach ($liveFootball as $index => $football)
                            <div class="services-box border p-3 football-item"
                                style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; display: {{ $index < 4 ? 'block' : 'none' }};">
                                <a href="" class=" text-black mb-2 w-full block text-center"
                                    style="font-size: 12px; line-height: 20px;">{{ $football['Name'] }}</a>
                                <hr class="mb-1">
                                <div class="match-container">
                                    <iframe src="https://live.oldd247.com/sr.php?eventid={{ $football['MatchID'] }}"
                                        width="200" height="100" style="border: 1px solid #ccc;"
                                        allowfullscreen></iframe>
                                    <div class="live-button-container">
                                        <a href="{{ Auth::check() ? route('live.stream', ['eventId' => $football['MatchID'], 'sportId' => 1, 'channelId' => $football['Channel']]) : '#' }}"
                                            onclick="checkLogin(event)">
                                            <button type="submit" class="btn-action btn-live">Live Match</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="w-100 text-center">
                            <p class="text-black">No match is live</p>
                        </div>
                    @endif
                </div>

                @if (count($liveFootball) > 4)
                    <div class="text-center mt-3">
                        <button class="btn btn-primary seeMoreBtn" data-container="football">See More</button>
                    </div>
                @endif
            </div>

            <!-- JavaScript -->
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    let seeMoreButtons = document.querySelectorAll(".seeMoreBtn");

                    seeMoreButtons.forEach(button => {
                        button.addEventListener("click", function() {
                            let sport = this.getAttribute("data-container");
                            let items = document.querySelectorAll(`.${sport}-item`);
                            let hiddenItems = Array.from(items).filter(item => item.style.display ===
                                "none");

                            hiddenItems.slice(0, 4).forEach(item => item.style.display = "block");

                            // Hide button when all items are visible
                            if (Array.from(items).every(item => item.style.display === "block")) {
                                this.style.display = "none";
                            }
                        });
                    });
                });
            </script>


        </section>
    </div>

    <script>
        function toggleGames(gameType, clickedButton) {
            // Select all game buttons and remove the 'active' class from them
            const buttons = document.querySelectorAll('.game-button');
            buttons.forEach(button => button.classList.remove('active'));

            // Add 'active' class to the clicked button
            clickedButton.classList.add('active');

            // Hide all game containers
            document.querySelector('.container-cricket').classList.remove('active');
            document.querySelector('.container-tennis').classList.remove('active');
            document.querySelector('.container-football').classList.remove('active');

            // Show the selected game container
            if (gameType === 'cricket') {
                document.querySelector('.container-cricket').classList.add('active');
            } else if (gameType === 'tennis') {
                document.querySelector('.container-tennis').classList.add('active');
            } else if (gameType === 'football') {
                document.querySelector('.container-football').classList.add('active');
            }
        }

        // Set the default active button (Cricket) on page load
        document.addEventListener('DOMContentLoaded', () => {
            const cricketButton = document.querySelector('.game-button[data-game="cricket"]');
            toggleGames('cricket', cricketButton);
        });
    </script>
@endsection
