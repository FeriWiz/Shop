<?php

namespace App\Livewire\Admin;

use App\Models\PropertyGroup;
use Livewire\Component;
use Livewire\WithPagination;

class PropertyGroups extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $property_groups = PropertyGroup::query()->paginate(10);
        return view('livewire.admin.property-groups', compact('property_groups'));
    }
}
