<div>
    <form wire:submit.prevent="create">
        <x-form.input type="text" label="true" key="name" name="name"
                      labelName="name"/>
        <x-form.input type="email" label="true" key="email" name="email"
                      labelName="email"/>
        <x-form.input type="password" label="true" key="password" name="password"
                      labelName="Password"/>
        <x-form.select name="role" label="true" labelName="Role"
                       id="role" :elements="$roles"/>
        <button class="btn btn-primary">Add</button>

    </form>
</div>
