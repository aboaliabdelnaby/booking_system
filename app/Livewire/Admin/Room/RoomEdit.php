<?php

namespace App\Livewire\Admin\Room;

use App\Enum\RoomType;
use App\Models\Room;
use App\MyPackages\Livewire\Components\Traits\EditHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\Validation\Room\UpdateValidationRules;
use Livewire\Component;

class RoomEdit extends Component
{
    use EditHelper;

    public string $name='';
    public string $price='';
    public string|RoomType $type='';
    public $types='';
    protected string $message = '';
    protected string $view = 'admin.room.room-edit';
    protected string $route = 'admin.room.index';
    private $query;


    public function __construct($id = null)
    {
        $this->updateValidation = app(UpdateValidationRules::class);
        $this->query = app(Pipeline::class)->setModel(Room::class);
        $this->message = 'Room has been updated successfully';
        $this->types=RoomType::toArray();
    }

    public function mount(Room $room): void
    {
        $this->rowId = $room->id;
        $this->name = $room->name;
        $this->price = $room->price;
        $this->type = $room->type;
    }

    public function update(): mixed
    {
        $validatedData = $this->validate();
        $admin = $this->query->where('id', $this->rowId)->update($validatedData);
        session()->flash('success', $this->message);
        return redirect()->route($this->route);
    }

    protected function rules(): array
    {
        return $this->updateValidation::rules($this->rowId);
    }
}
