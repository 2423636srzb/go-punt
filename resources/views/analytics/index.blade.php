@extends('layout.layout')

@php
    $title = 'Analytics';
    $subTitle = 'Analytics';
@endphp

@section('content')

<div class="row row-cols-xxxl-4 row-cols-lg-4  row-cols-sm-2 row-cols-1 gy-4">
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-1 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Active Users</p>
                        <h6 class="mb-0">{{ $activeUsers->rows[0]->metricValues[0]->value ?? 'No active users' }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        
                    </span>
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-5 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">New Users</p>
                        <h6 class="mb-0">{{ $newUsers->rows[0]->metricValues[0]->value ?? 'N/A' }}</h6>
                    </div>
                    <div class="w-50-px h-50-px bg-red rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fa6-solid:user-plus" class="text-white text-2xl mb-0"></iconify-icon>

                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                        
                    </span>
                  
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-3 h-100">
            <div class="card-body p-20">
                <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Unique Users</p>
                        <h6 class="mb-0"> {{ $uniqueUsers->rows[0]->metricValues[0]->value ?? 'N/A' }}</h6>
                    </div>
                    <div
                        class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                        <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl"></iconify-icon>
                    </div>
                </div>
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-info-main">
                        
                    </span>
                    
                </p>
            </div>
        </div><!-- card end -->
    </div>
    <div class="col">
        <div class="card shadow-none border bg-gradient-start-4 h-100">
            <div class="card-body p-20">
                <div class="d-flex align-items-center justify-content-between">
                    <!-- Text Section -->
                    <div>
                        <p class="fw-medium text-primary-light mb-1">Avg Engagement Time</p>
                        <h6 class="mb-0">
                            {{ $avgEngagementTimeFormatted }}
                        </h6>
                    </div>
                    <!-- Icon Section -->
                    <div class="w-50-px h-50-px bg-success-main rounded-circle d-flex justify-content-center align-items-center" style="margin-top: -15px;">
                        <iconify-icon icon="fluent:timer-20-filled" class="text-white text-2xl"></iconify-icon>
                    </div>
                </div>
                <!-- Additional Details -->
                <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                    <span class="d-inline-flex align-items-center gap-1 text-success-main">
                        <!-- Additional content -->
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    
</div>
{{-- <div class="container">
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
</div> --}}
@endsection
