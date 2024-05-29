<x-slot name="title">
    Edit Room
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left"> Edit Room</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <form wire:submit.prevent="update">
                        <x-form.input type="text" label="true" key="name" name="name"
                                      labelName="name"/>
                        <x-form.input type="text" label="true" key="price" name="price"
                                      labelName="price"/>
                        <x-form.select name="type" label="true" labelName="type"
                                       id="type" :elements="$types"/>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
