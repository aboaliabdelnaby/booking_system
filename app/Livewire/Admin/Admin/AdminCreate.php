<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use App\Models\Role;
use App\MyPackages\Livewire\Components\Traits\CreateHelper;
use App\MyPackages\Livewire\Filters\Pipeline;
use App\Validation\Admin\StoreValidationRules;
use Livewire\Component;

class AdminCreate extends Component
{
    use CreateHelper;
    public string $name='';
    public string $email='';
    public string $password='';
    public string $role='';
    public $roles='';

    protected string $message = '';
    protected string $view = 'admin.admin.admin-create';
    private $query;
    public function __construct()
    {
        $this->storeValidation = app(StoreValidationRules::class);
        $this->query = app(Pipeline::class)->setModel(Admin::class);
        $this->message = 'Admin has been created successfully';
        $this->roles=Role::allRoles();
    }

    public function create():void
    {
        $validatedData = $this->validate();
        $admin=$this->query->create($validatedData);
        $admin->assignRole($this->role);
        $this->resetInputFields();
        $this->dispatch('creating', $this->message);
    }

    protected function resetInputFields(): void
    {
        $this->reset(['name','email','role','password']);
        $this->dispatch('refreshComponent');
    }
}
