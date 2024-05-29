<div>
    <form wire:submit.prevent="create">
        <x-form.input type="text" label="true" key="name" name="name"
                      labelName="name"/>
        <x-form.input type="text" label="true" key="price" name="price"
                      labelName="price"/>
        <x-form.select name="type" label="true" labelName="type"
                       id="type" :elements="$types"/>
        <button class="btn btn-primary">Add</button>

    </form>
</div>
