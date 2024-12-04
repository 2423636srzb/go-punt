<?php

use Illuminate\Support\Facades\Broadcast;

// Example of a public channel
Broadcast::channel('public-channel', function ($user) {
    return true; // All users can listen to this channel
});

// Example of a private channel (authenticated users only)
Broadcast::channel('private-channel.{userId}', function ($user, $userId) {
    return (int) $user->id === (int) $userId; // Only the user with the correct ID can listen
});

Broadcast::channel('user.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id; // Authenticate the channel
});