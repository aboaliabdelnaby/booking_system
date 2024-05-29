<?php

namespace App\Livewire\Admin\Request;

use App\Enum\RequestStatus;
use App\Enum\RoomStatus;
use App\Models\Request;
use App\MyPackages\Livewire\Components\Traits\IndexHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\MyPackages\Livewire\Filters\SearchFilterPipeline;
use App\MyPackages\Livewire\Filters\SortFilterPipeline;
use Livewire\Component;
use Livewire\WithPagination;

class RequestIndex extends Component
{
    use WithPagination, IndexHelper;

    protected string $view = 'admin.request.request-index';
    protected array $searchColumns = ['status'];
    protected $listeners = ['refreshComponent' => '$refresh', 'executeAction'];
    protected string $message = '';
    private $query;
    public function __construct()
    {
        $this->query = app(Pipeline::class)->setModel(Request::class);
        $this->message='Request has been deleted successfully';
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
    public function executeAction(array $row):void
    {
        $status=$row['action']=='approve'? RequestStatus::APPROVED->value : RequestStatus::REJECTED->value;
        $roomStatus=$row['action']=='approve'? RoomStatus::BOOKED->value : RoomStatus::AVAILABLE->value;
        $request=$this->query->where('id',$row['id'])->first();
        $request->update(['status'=>$status]);
        $request->room()->update(['status'=>$roomStatus]);
        $this->dispatch('success', $this->message);
    }
}
