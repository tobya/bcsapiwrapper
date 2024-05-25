<?php

  namespace Bcsapi\Passport\Services;

  use Bcsapi\Passport\User;
  use Illuminate\Support\Facades\Log;
  use Spatie\Permission\Models\Role;

  class RoleSyncService
  {
    public static function SyncRoles($user, $tag)
    {
        $tag = str($tag)->lower();

        if (!$user->access_token){
            Log::warning("User $user->name needs to logout (fully) and log back in again");
            return [];
        }
        //Sync Roles

        $response = \Bcsapi\Passport\User::RetrieveRoles($user);
        ray($response);
        $roles = $response->object();

        if (isset($roles->message)){
            if ($roles->message == 'Unauthenticated.'){
                throw new \Exception('Passport Unauthenticated with User Token');
            }
        }

        // keep only roles that have tag.
        $rolesToApply = collect($roles->roles)->map(function ($role) use ($tag){
            if (Str($role->name)->lower()->contains($tag)){
                return Str( $role->name)->remove(["x-$tag",$tag],false)->trim()->toString();
            }
            return '';
        })->filter(function ($value){
            return $value <> '';
        });

        //Check if all the roles exists in the $tag database
        foreach($rolesToApply as $role){
            if(!Role::where('name',$role)->exists()){
                Role::create(['name' => $role]);
            }
        }

        $user->syncRoles( $rolesToApply->toArray());
        if (isset($user->attributes['individualid'])){
          @$user->individualid = $roles->user->individualid ;
        }
        $user->email = $roles->user->email;
        $user->save();
        return $roles;
  }
  }
