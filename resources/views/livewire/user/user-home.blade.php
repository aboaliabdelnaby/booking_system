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
            </div>
            <div class="card-body">
                <div class="row">
                    @forelse($data as $row)
                        <div class="col-md-3">
                            <div class="card" style="width: 18rem;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $row->name }}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">{{ $row->price }} </h6>
                                    <p class="card-text">{{  $row->type }}</p>
                                    <a wire:click="$dispatch('booking',{ id: {{$row->id}},name:'room' })"
                                       class="btn btn-dark mb-2 text-white">
                                        Book
                                    </a>
                                </div>
                            </div>
                        </div>

                    @empty

                        <div class="text-center mt-2" style="font-size: 18px;">
                            No Data Found
                        </div>

                    @endforelse

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
    Livewire.on('booking', (id) => {
        Swal.fire({
            title: 'warning',
            text: 'Are you sure you want to book this room',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Book',
            padding: '2em'
        }).then(function (result) {
            if (result.value) {
                Livewire.dispatch('book', id);

            }
        })
    });
</script>
@endscript
