<?php

namespace App\Listeners;

use Laravel\Passport\Events\RefreshTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Queue\ShouldQueue;

class PruneOldToken
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
     * @param  RefreshTokenCreated  $event
     * @return void
     */
    public function handle(RefreshTokenCreated $event)
    {
        //
        $oauth_refresh_token = DB::table('oauth_refresh_tokens')
            ->where('id','<>',$event->refreshTokenId)
            ->where('access_token_id','<>',$event->accessTokenId);
        if($oauth_refresh_token){
            $oauth_refresh_token->update(['revoked'=>true]);
        }

    }
}
