<?php

namespace App\Livewire\Admin;

use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;

class Properties extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $properties = Property::query()->paginate(10);
        return view('livewire.admin.properties', compact('properties'));
    }
}
