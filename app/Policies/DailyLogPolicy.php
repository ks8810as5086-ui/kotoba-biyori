<?php

namespace App\Policies;

use App\Models\DailyLog;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class DailyLogPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, DailyLog $dailyLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * 日報の更新権限があるかの判定
     */
    public function update(User $user, DailyLog $dailyLog): bool
    {
        return $user->id === $dailyLog->user_id;
    }

    /**
     * 日報の削除権限があるかの判定
     */
    public function delete(User $user, DailyLog $dailyLog): bool
    {
        return $user->id === $dailyLog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, DailyLog $dailyLog): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, DailyLog $dailyLog): bool
    {
        return false;
    }
}
