<?php
namespace App\Validation\Room;

use App\Enum\RoomType;
use App\MyPackages\Livewire\Validation\Validation;
use Illuminate\Validation\Rules\Enum;

class StoreValidationRules implements Validation
{
    public static function rules(): array
    {
        return [
            'name'=> ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'type'=>  [new Enum(RoomType::class)],
        ];
    }

}
