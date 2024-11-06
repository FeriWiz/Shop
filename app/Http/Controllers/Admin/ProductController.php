<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست محصولات';
        return view('admin.product.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'اضافه کردن محصول';
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('title', 'id');
        return view('admin.product.create', compact('title', 'categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = Product::saveImage($request->file);
        Product::query()->create([
            'title' => $request->input('title'),
            'title_en' => $request->input('title_en'),
            'slug' => Helper::make_slug($request->input('title')),
            'price' => $request->input('price'),
            'count' => $request->input('count'),
            'image' => $image,
            'guarantee' => $request->input('guarantee'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'is_special' => $request->input('is_special') === 'on',
            'special_expiration' => ($request->input('special_expiration') != null ? Verta::parse($request->input('special_expiration'))->DateTime()->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s')),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return to_route('products.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'ویرایش محصول';
        $product = Product::query()->findOrFail($id);
        $categories = Category::query()->pluck('title', 'id');
        $brands = Brand::query()->pluck('title', 'id');

        return view('admin.product.edit', compact('title', 'categories', 'brands', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::query()->findOrFail($id);

        $image = $request->file? Product::saveImage($request->file): $product->image;
        Product::query()->update([
            'title' => $request->input('title'),
            'title_en' => $request->input('title_en'),
            'slug' => Helper::make_slug($request->input('title')),
            'price' => $request->input('price'),
            'count' => $request->input('count'),
            'image' => $image,
            'guarantee' => $request->input('guarantee'),
            'discount' => $request->input('discount'),
            'description' => $request->input('description'),
            'is_special' => $request->input('is_special') === 'on',
            'special_expiration' => ($request->input('special_expiration') != null ? Verta::parse($request->input('special_expiration'))->DateTime()->format('Y-m-d H:i:s') : now()->format('Y-m-d H:i:s')),
            'category_id' => $request->input('category_id'),
            'brand_id' => $request->input('brand_id'),
        ]);

        return to_route('products.index')->with('success', 'محصول با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        if ($product->image){
            $path1 = public_path().'/images/admin/products/big/'.$product->image;
            $path2 = public_path().'/images/admin/products/small/'.$product->image;
            unlink($path1);
            unlink($path2);
        }

        $product->delete();

        return redirect()->back()->with('success', 'محصول با موفقیت حذف شد');
    }
}
