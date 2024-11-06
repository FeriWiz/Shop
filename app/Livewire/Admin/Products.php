<?php

namespace App\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {
        $products = Product::query()->paginate(10);
        return view('livewire.admin.products', compact('products'));
    }
}
