<x-slot name="title">
    Edit Admin
</x-slot>
<div>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 style="float: left"> Edit Admin</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <form wire:submit.prevent="update">
                        <x-form.input type="text" label="true" key="name" name="name"
                                      labelName="name"/>
                        <x-form.input type="email" label="true" key="email" name="email"
                                      labelName="email"/>
                        <x-form.input type="password" label="true" key="password" name="password"
                                      labelName="Password"/>
                        <x-form.select name="role" label="true" labelName="Role"
                                       id="role" :elements="$roles"/>
                        <button class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
