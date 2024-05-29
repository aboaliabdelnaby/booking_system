<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as RoleModel;

class Role extends RoleModel
{
    use HasFactory;

    public const TABLE = '_roles';
    protected $table = '_roles';

    /**
     * @return array
     */
    public static function allRoles(): array
    {
        $roles = [];
        $nameField = self::nameField();
        foreach (self::all() as $role) {
            $roles[$role->{$nameField}] = ucfirst($role->{$nameField});
        }
        return $roles;
    }

    /**
     * @return string
     */
    final public static function nameField(): string
    {
        return 'name';
    }
}
