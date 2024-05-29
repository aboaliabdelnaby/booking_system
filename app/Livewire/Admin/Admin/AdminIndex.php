<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use App\MyPackages\Livewire\Components\Traits\IndexHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\MyPackages\Livewire\Filters\SearchFilterPipeline;
use App\MyPackages\Livewire\Filters\SortFilterPipeline;
use Livewire\Component;
use Livewire\WithPagination;

class AdminIndex extends Component
{
    use WithPagination, IndexHelper;

    protected string $view = 'admin.admin.admin-index';
    protected array $searchColumns = ['name', 'email'];
    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];
    protected string $message = '';
    private $query;
    public function __construct()
    {
        $this->query = app(Pipeline::class)->setModel(Admin::class);
        $this->message='Admin has been deleted successfully';
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
