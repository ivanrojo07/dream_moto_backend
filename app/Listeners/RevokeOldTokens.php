<?php

namespace App\Listeners;

use Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class RevokeOldTokens
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        //
        $oauth_access_token = DB::table('oauth_access_tokens')
            ->where('id','<>',$event->tokenId)
            ->where('user_id',$event->userId)
            ->where('client_id',$event->clientId);
        if ($oauth_access_token) {
            $oauth_access_token->update(['revoked'=>true]);
        }
    }
}
