<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Livewire\Component;

class Galleries extends Component
{
    public function render()
    {
        $galleries = Gallery::query()->get();
        return view('livewire.admin.galleries', compact('galleries'));
    }
}
