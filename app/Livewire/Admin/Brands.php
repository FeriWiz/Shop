<?php

namespace App\Livewire\Admin;

use App\Models\Brand;
use Livewire\Component;
use Livewire\WithPagination;

class Brands extends Component
{
    public $search;
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public function render()
    {
        $brands = Brand::query()->
            where('title', 'like', '%' . $this->search . '%')->
            paginate(10);
        return view('livewire.admin.brands', compact('brands'));
    }
}
