<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Product;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function addGallery($id)
    {
        $product = Product::query()->findOrFail($id);
        return view('admin.product.create_gallery', compact('product'));
    }

    public function storeGallery(Request $request, $id)
    {
        $image = Gallery::saveImage($request->file);
        Gallery::query()->create([
            'image' =>$image,
            'product_id' =>$id
        ]);

        return redirect()->back()->with('success', 'عکس با موفقیت ذخیر شد');
    }
}
