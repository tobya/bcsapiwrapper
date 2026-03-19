<?php

namespace Bcsapi\Passport\Middleware;


use Bcsapi\Passport\Jobs\FetchUserRolesJob;
use Closure;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\DataCollector\LoggerDataCollector;

/**
 * This job is called by the CheckRoleMiddleware and run as a job rather than inline to avoid
 * slowing down requests
 */
class CheckUserRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if($user ){

            // if no roles, call immediatly
            if ($user->roles()->count() == 0){
              try {

                  \Bcsapi\Passport\Services\RoleSyncService::SyncRoles($user,config('bcsapi.passport.client_roletag'));
                  Log::debug('First role check for ' . $user->name . '. Roles have been fetched');
              } catch (  \Exception $e)
              {
                  // sometimes with weird login stuff this can cause an error, it is best to ignore it, until fixed.
                  // The user will might be logged in to staffrota but not backoffice. This happens with magic login.
              }
            } else {

                // otherwise call check once every 3 minute.
                $cacheuser = Cache::remember('cacheuser_' . $user->id ,160 ,function () use ($user){
                    dispatch(new FetchUserRolesJob($user));
                    Log::debug('check with cache ' . $user->name . '. Roles have been fetched');
                   return 'Roles have been fetched';
                });
            }
        }

        return $next($request);
    }
}
