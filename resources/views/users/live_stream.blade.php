@extends('layout.layout')

@php
    $title = 'Live Matches';
    $subTitle = 'Live Matches';
@endphp

@section('content')

    <div class="card">

        <div class="container" style="margin-bottom: 50px;">
            <div class="flex gap-10">
                <div class="services-box border p-3" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 4px 15px 0px; height: 315px; width: 350px; min-width: 350px; border-radius: 15px; background-color:#0c243d; margin-top:100px;">

              <iframe
                  src="https://live.oldd247.com/sr.php?eventid={{$eventId}}"
                  style="width: 100%; height: 100%; border: 1px solid #ccc;"
                  allowfullscreen>
              </iframe>
                  {{-- <div class="match-container">
                    <!-- Pakistan Team Info -->
                    <div class="team-container">
                      <div class="team">
                        <p class="batting">Pak <span style="color: #ff002b">*</span></p>
                      </div>
                      <div class="stats">
                        <p><span class="batting">45-3</span> <span class="overs">(7.3)</span></p>
                      </div>
                    </div>

                    <div class="team-container">
                      <div class="team"></div>
                      <div class="stats">
                        <p class="-mt-2"><span class="overs">CRR (7.2)</span></p>
                      </div>
                    </div>
                    <div class="team-container">
                      <div class="team">
                        <p>Ind</p>
                      </div>
                      <div class="stats">
                        <p><span>38-2</span> <span class="overs">(7.2)</span></p>
                      </div>
                    </div>
                    <hr class="mt-1">
                    <div class="team mt-1">
                      <p class="batting">last 6 ball</p>
                    </div>
                    <div class="balls-container">
                      <div class="ball">1</div>
                      <div class="ball">0</div>
                      <div class="ball">4</div>
                      <div class="ball">6</div>
                      <div class="ball">1</div>
                      <div class="ball">0</div>
                    </div>
                    <hr class="my-2.5" />
                    <p style="font-size: 17px; font-weight: 700; color:#0056b3; margin: 20px auto; margin-left: 100px;">Pak needs 45 runs in 18 balls</p>
                  </div> --}}
                </div>
                <!-- Right Side: Video Player (Live Stream) -->
                <div class="tv-container">
                  <h4 class="tv-title">Live TV Streaming</h4>
                  <div class="tv-frame">
                      <iframe
                          src="https://live.oldd247.com/betfairtv/?cid={{$channelId}}"
                          frameborder="0"
                          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                          allowfullscreen>
                      </iframe>
                  </div>
              </div>
            </div>
        </div>
    </div>
@endsection
