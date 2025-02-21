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
                            <th scope="col">Redeem</th>
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

                        </tr>
                    @endforeach
            </tbody>
            </table>
        </div>


    </div>
    </div>


@endsection

