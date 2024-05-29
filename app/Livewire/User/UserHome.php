<?php

namespace App\Livewire\User;

use App\Enum\RoomStatus;
use App\Models\Room;
use App\MyPackages\Livewire\Components\Traits\IndexHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\MyPackages\Livewire\Filters\SearchFilterPipeline;
use App\MyPackages\Livewire\Filters\SortFilterPipeline;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class UserHome extends Component
{
    use WithPagination, IndexHelper;

    protected string $view = 'user.user-home';
    protected array $searchColumns = ['name', 'price','type','status'];
    protected $listeners = ['refreshComponent' => '$refresh', 'book'];
    protected string $message = '';
    private $query;
    public function __construct()
    {
        $this->query = app(Pipeline::class)->setModel(Room::class);
        $this->message='Room has been booked successfully';
    }

    #[Layout('layouts.app_user')]
    public function render()
    {
        $data=$this->query->pushPipeline([
            new SearchFilterPipeline($this->searchColumns, $this->search),
            new SearchFilterPipeline(['status'], RoomStatus::AVAILABLE->value),
            new SortFilterPipeline($this->sortField, $this->sortType)
        ])->paginate($this->paginatePerPage);
        return view(
            view: 'livewire.' . $this->view,
            data: get_defined_vars()
        );
    }
    public function book(int $id):void
    {
        $room=$this->query->where('id',$id)->first();
        $room->update(['status'=>RoomStatus::PENDING->value]);
        $room->requests()->create(['user_id'=>auth()->id()]);
        $this->dispatch('success', $this->message);
    }
}
