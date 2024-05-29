<?php
namespace App\Validation\Admin;

use App\MyPackages\Livewire\Validation\Validation;

class StoreValidationRules implements Validation
{
    public static function rules(): array
    {
        return [
            'name'=> ['required', 'string', 'max:255'],
            'role' => ['required', 'string', "exists:roles,name"],
            'password'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'email','regex:/(.+)@(.+)\.(.+)/i', 'max:255', 'unique:admins'],
        ];
    }

}
