<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('pool.{id}', function ($user, $user_id) {
    
    //$pool = FileNotification::find($poolId);
    //(int) $user->id === (int) $user_id
    return true;
});
