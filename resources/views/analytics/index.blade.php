@extends('layout.layout')

@php
    $title = 'Google Analytics';
    $subTitle = 'Google Analytics';
@endphp

@section('content')
<div class="container">
    <h1>Google Analytics Data</h1>

    <div class="row">
        <div class="col-md-6">
            <h2>Active Users</h2>
            <p>
                {{ $activeUsers->rows[0]->metricValues[0]->value ?? 'No active users' }}
            </p>
        </div>

        <div class="col-md-6">
            <h2>Unique Users (Last 7 Days)</h2>
            <p>
                {{ $uniqueUsers->rows[0]->metricValues[0]->value ?? 'N/A' }}
            </p>
        </div>
    </div>
</div>
@endsection
