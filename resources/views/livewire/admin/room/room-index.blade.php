<x-slot name="title">
    Rooms
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left">Rooms</h2>
                <div style="float:right;">
                    <input type="text"
                           wire:model.live="search"
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Search"
                    />
                </div>
                <x-general.create-modal title="Create Room">
                    <x-slot name="form">
                        @can('admin.room.create')
                            <livewire:admin.room.room-create/>
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
                            <x-datatable.th sortByColumn="price"
                                            labelName="price"/>
                            <x-datatable.th sortByColumn="type"
                                            labelName="type"/>
                            <x-datatable.th sortByColumn="status"
                                            labelName="status"/>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->price }}</td>
                                <td>{{ $row->type }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    @can('admin.room.edit')
                                        <a class="btn btn-success mb-2"
                                           href="{{route('admin.room.edit',$row->id)}}">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('admin.room.delete')
                                        <a wire:click="$dispatch('deleting',{ id: {{$row->id}},name:'room' })"
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
