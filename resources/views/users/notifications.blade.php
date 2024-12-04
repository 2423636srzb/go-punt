@extends('layout.layout')

@php
    $title = 'Notification';
    $subTitle = 'Notification';
@endphp

@section('content')
<div class="container">
    <h1>Your Notifications</h1>
    <ul class="list-group">
        @foreach (Auth::user()->notifications as $notification)
            <li class="list-group-item">
                {{ $notification->data['message'] }}
                @if (!$notification->read_at)
                    <a href="{{ route('notifications.read', $notification->id) }}" class="btn btn-sm btn-primary">Mark as Read</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
