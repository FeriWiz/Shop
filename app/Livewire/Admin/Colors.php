<?php

namespace App\Livewire\Admin;

use App\Models\Color;
use Livewire\Component;

class Colors extends Component
{
    public function render()
    {
        $colors = Color::query()->paginate(10);
        return view('livewire.admin.colors', compact('colors'));
    }
}
