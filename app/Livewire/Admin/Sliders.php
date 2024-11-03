<?php

namespace App\Livewire\Admin;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithPagination;

class Sliders extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function render()
    {
        $sliders = Slider::query()->
            where('title', 'like', '%' . $this->search . '%')->
            paginate(10);

        return view('livewire.admin.sliders', compact('sliders'));
    }

}
