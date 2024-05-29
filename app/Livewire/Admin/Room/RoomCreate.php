<?php

namespace App\Livewire\Admin\Room;

use App\Enum\RoomType;
use App\Models\Room;
use App\MyPackages\Livewire\Components\Traits\CreateHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\Validation\Room\StoreValidationRules;
use Livewire\Component;

class RoomCreate extends Component
{
    use CreateHelper;
    public string $name='';
    public string $price='';
    public string|RoomType $type='';
    public $types='';

    protected string $message = '';
    protected string $view = 'admin.room.room-create';
    private $query;
    public function __construct()
    {
        $this->storeValidation = app(StoreValidationRules::class);
        $this->query = app(Pipeline::class)->setModel(Room::class);
        $this->message = 'Room has been created successfully';
        $this->types=RoomType::toArray();
    }

    public function create():void
    {
        $validatedData = $this->validate();
        $admin=$this->query->create($validatedData);
        $this->resetInputFields();
        $this->dispatch('creating', $this->message);
    }

    protected function resetInputFields(): void
    {
        $this->reset(['name','price','type']);
        $this->dispatch('refreshComponent');
    }
}
