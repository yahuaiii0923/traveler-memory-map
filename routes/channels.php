<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('test-channel', function ($user) {
    return ['id' => $user->id, 'name' => $user->name];
});
