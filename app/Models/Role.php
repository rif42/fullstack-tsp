<?php
class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

// Permission model
class Permission extends Model
{
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
