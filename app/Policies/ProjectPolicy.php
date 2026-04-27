<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;

class ProjectPolicy
{
    /**
     * Only admin can approve/reject
     */
    public function approve(User $user, Project $project)
    {
        return $user->role === 'admin';
    }
}