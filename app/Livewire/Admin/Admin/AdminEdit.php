<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\MyPackages\Livewire\Components\Traits\EditHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\Validation\Admin\UpdateValidationRules;
use Illuminate\Support\Arr;
use Livewire\Component;

class AdminEdit extends Component
{
    use EditHelper;

    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $role = '';
    protected string $message = '';
    public $roles = '';
    protected string $view = 'admin.admin.admin-edit';
    protected string $route = 'admin.index';
    private $query;


    public function __construct($id = null)
    {
        $this->updateValidation = app(UpdateValidationRules::class);
        $this->query = app(Pipeline::class)->setModel(Admin::class);
        $this->message = 'Admin has been updated successfully';
        $this->roles = Role::allRoles();
    }

    public function mount(Admin $admin): void
    {
        $this->rowId = $admin->id;
        $this->name = $admin->name;
        $this->email = $admin->email;
        $this->role = $admin->roles->pluck("name")->first();
    }

    public function update(): mixed
    {
        $validatedData = $this->validate();
        $validatedData = Arr::except($validatedData, ['role']);
        $admin = $this->query->where('id', $this->rowId)->first();
        $admin->update($validatedData);
        $admin->syncRoles($this->role);
        session()->flash('success', $this->message);
        return redirect()->route($this->route);
    }

    protected function rules(): array
    {
        return $this->updateValidation::rules($this->rowId);
    }
}
