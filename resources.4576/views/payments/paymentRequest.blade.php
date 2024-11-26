@extends('layout.layout')

@php
$title = 'Payment Request';
$subTitle = 'Payment Request';
@endphp

@section('content')

<div class="card">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <div class="d-flex align-items-center gap-2">
                <span>Show</span>
                <select class="form-select form-select-sm w-auto">
                    <option>10</option>
                    <option>15</option>
                    <option>20</option>
                </select>
            </div>
            <div class="icon-field">
                <input type="text" name="#0" class="form-control form-control-sm w-auto" placeholder="Search">
                <span class="icon">
                    <iconify-icon icon="ion:search-outline"></iconify-icon>
                </span>
            </div>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-3">
            <select class="form-select form-select-sm w-auto">
                <option>Satatus</option>
                <option>Paid</option>
                <option>Pending</option>
            </select>

        </div>
    </div>
    <div class="card-body">
        <table class="table bordered-table mb-0">
            <thead>
                <tr>

                    <th scope="col">Request ID</th>
                    <th scope="col">Platform Name</th>
                    <th scope="col">Request Date/Time</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">BMW</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024 23:00:00</td>
                    <td>{{setCurrency(20)}}</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>


                    </td>
                </tr>
                <tr>

                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">BMW</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024 23:00:00</td>
                    <td>{{setCurrency(20)}}</td>
                    <td> <span
                            class="bg-warning-focus text-warning-main px-24 py-4 rounded-pill fw-medium text-sm">Pending</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>

                        <a href="javascript:void(0)" title="Approve"
                            class="w-32-px h-32-px bg-success-focus text-success-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="charm:tick"></iconify-icon>
                        </a>

                        <a href="javascript:void(0)" title="Reject"
                            class="w-32-px h-32-px bg-danger-focus text-danger-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="twemoji:cross-mark"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>

                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">BMW</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024 23:00:00</td>
                    <td>{{setCurrency(20)}}</td>
                    <td> <span
                            class="bg-danger-focus text-danger-main px-24 py-4 rounded-pill fw-medium text-sm">Declined</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                    </td>
                </tr>
                <tr>

                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">BMW</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024 23:00:00</td>
                    <td>{{setCurrency(20)}}</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>


                    </td>
                </tr>
                <tr>

                    <td><a href="javascript:void(0)" class="text-primary-600">#526534</a></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('assets/images/user-list/user-list1.png') }}" alt=""
                                class="flex-shrink-0 me-12 radius-8">
                            <h6 class="text-md mb-0 fw-medium flex-grow-1">BMW</h6>
                        </div>
                    </td>
                    <td>25 Jan 2024 23:00:00</td>
                    <td>{{setCurrency(20)}}</td>
                    <td> <span
                            class="bg-success-focus text-success-main px-24 py-4 rounded-pill fw-medium text-sm">Paid</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)"
                            class="w-32-px h-32-px bg-primary-light text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <iconify-icon icon="iconamoon:eye-light"></iconify-icon>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mt-24">
            <span>Showing 1 to 10 of 12 entries</span>
            <ul class="pagination d-flex flex-wrap align-items-center gap-2 justify-content-center">
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base"
                        href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-left" class="text-xl"></iconify-icon>
                    </a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-600 text-white fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px"
                        href="javascript:void(0)">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px"
                        href="javascript:void(0)">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link bg-primary-50 text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px"
                        href="javascript:void(0)">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link text-secondary-light fw-medium radius-4 border-0 px-10 py-10 d-flex align-items-center justify-content-center h-32-px w-32-px bg-base"
                        href="javascript:void(0)">
                        <iconify-icon icon="ep:d-arrow-right" class="text-xl"></iconify-icon>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

@endsection