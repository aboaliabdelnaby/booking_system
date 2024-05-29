<?php

namespace App\Livewire\Admin\Room;

use App\Models\Room;
use App\MyPackages\Livewire\Components\Traits\IndexHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\MyPackages\Livewire\Filters\SearchFilterPipeline;
use App\MyPackages\Livewire\Filters\SortFilterPipeline;
use Livewire\Component;
use Livewire\WithPagination;

class RoomIndex extends Component
{
    use WithPagination, IndexHelper;

    protected string $view = 'admin.room.room-index';
    protected array $searchColumns = ['name', 'price','type','status'];
    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];
    protected string $message = '';
    private $query;
    public function __construct()
    {
        $this->query = app(Pipeline::class)->setModel(Room::class);
        $this->message='Room has been deleted successfully';
    }

    public function render()
    {
        $data=$this->query->pushPipeline([
            new SearchFilterPipeline($this->searchColumns, $this->search),
            new SortFilterPipeline($this->sortField, $this->sortType)
        ])->paginate($this->paginatePerPage);
        return view(
            view: 'livewire.' . $this->view,
            data: get_defined_vars()
        );
    }
    public function delete(int $id):void
    {
        $this->query->where('id',$id)->delete();
        $this->dispatch('success', $this->message);
    }
}
