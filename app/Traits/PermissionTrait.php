<?php
namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait PermissionTrait
{
    protected $permissionList = null;

    /**
     * Roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_users', 'user_id', 'role_id');
    }

    /**
     * Has role
     *
     * @param $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if(is_string($role)) {
           return $this->roles->contains('name', $role);
        }
        return false;
    }

    public function hasPermission($permission = null)
    {
        if(is_string($permission)) {
           return $this->getPermissions()->contains('name', $permission);
        }
        return false;
    }

    private function getPermissions()
    {
        $role = $this->roles->first();
        if ($role) {
            if (! $role->relationLoaded('permissions')) {
                $this->roles->load('permissions');
            }

            $this->permissionList = $this->roles->pluck('permissions')->flatten();
        }

        return $this->permissionList ?? collect();
    }
}
