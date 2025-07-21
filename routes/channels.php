<?php

use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('newUser', function ($user) {
    return $user;
});
