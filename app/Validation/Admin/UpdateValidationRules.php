<?php

namespace App\Validation\Admin;

use App\MyPackages\Livewire\Validation\Validation;

class UpdateValidationRules implements Validation
{

    public static function rules($id=null): array
    {
        return [
            'name'=> ['required', 'string', 'max:255'],
            'role'=> ['required', 'string', 'max:255'],
            'password'=> ['nullable', 'string', 'max:255'],
            'email'=> ['required', 'email','regex:/(.+)@(.+)\.(.+)/i', 'max:255',"unique:admins,email,$id,id"],
        ];
    }
}
