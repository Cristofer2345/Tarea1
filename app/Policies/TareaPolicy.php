<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TareaPolicy
{
    public function edit(User $user, Task $post): bool
    {
        return $post->user_id->is($user);
    }
}
