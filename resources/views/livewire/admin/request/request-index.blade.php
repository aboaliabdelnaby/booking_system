<x-slot name="title">
    Requests
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left">Requests</h2>
                <div style="float:right;">
                    <input type="text"
                           wire:model.live="search"
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Search"
                    />
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">User</th>
                            <th scope="col">Room</th>
                            <x-datatable.th sortByColumn="status"
                                            labelName="status"/>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($data as $row)
                            <tr>
                                <td>{{ $row->user->name }}</td>
                                <td>{{ $row->room->name }}</td>
                                <td>{{ $row->status }}</td>
                                <td>
                                    @can('admin.request.actions')
                                        <a wire:click="$dispatch('requestAction',{ id: {{$row->id}},action:'approve' })"
                                           class="btn btn-success mb-2 text-white">
                                            Approve
                                        </a>
                                        <a wire:click="$dispatch('requestAction',{ id: {{$row->id}},action:'reject' })"
                                           class="btn btn-danger mb-2 text-white">
                                            Reject
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
@script
<script>
    Livewire.on('requestAction', (data) => {
            Swal.fire({
                title: 'warning',
                text: 'Are you sure you want to '+data.action+' this room',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: data.action,
                padding: '2em'
            }).then(function (result) {
                if (result.value) {
                    Livewire.dispatch('executeAction', {row:data});

                }
            })
    });

</script>
@endscript
