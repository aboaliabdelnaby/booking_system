<x-slot name="title">
    Admins
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left">Admins</h2>
                <div style="float:right;">
                    <input type="text"
                           wire:model.live="search"
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Search"
                    />
                </div>
                <x-general.create-modal title="Create Admin">
                    <x-slot name="form">
                        @can('admin.create')
                            <livewire:admin.admin.admin-create/>
                        @endcan
                    </x-slot>
                </x-general.create-modal>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <x-datatable.th sortByColumn="name"
                                            labelName="name"/>
                            <x-datatable.th sortByColumn="email"
                                            labelName="email"/>
                            <th scope="col">role</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->roles->pluck("name")->first() }}</td>
                                <td>
                                    @can('admin.edit')
                                        <a class="btn btn-success mb-2"
                                           href="{{route('admin.edit',$row->id)}}">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('admin.delete')
                                        <a wire:click="$dispatch('deleting',{ id: {{$row->id}},name:'admin' })"
                                           class="btn btn-danger mb-2 text-white">
                                            Delete
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <td colspan="100%">
                                <div class="text-center mt-2" style="font-size: 18px;">
                                    No Data Found
                                </div>
                            </td>
                        @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="row float-end">
                    <div class="col">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
