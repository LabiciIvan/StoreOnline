<?php

namespace App\Policies;

use App\Models\Replay;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ReplayPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */

     public function delete(User $user,Replay $replay) {

        return $user->id == $replay->user_Id;
        // return true;
     }

     public function store(User $user) {

      return Auth::check();
     }
}
