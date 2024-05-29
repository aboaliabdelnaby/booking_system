<?php

namespace App\Validation\Room;

use App\Enum\RoomType;
use App\MyPackages\Livewire\Validation\Validation;
use Illuminate\Validation\Rules\Enum;

class UpdateValidationRules implements Validation
{

    public static function rules($id=null): array
    {
        return [
            'name'=> ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'type'=>  [new Enum(RoomType::class)],
        ];
    }
}
