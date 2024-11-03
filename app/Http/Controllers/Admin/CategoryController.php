<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست دسته بندی ها';
        return view('admin.category.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد دسته بندی';
        $categories = Category::query()->pluck('title', 'id');
        return view('admin.category.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = Category::saveImage($request->file);
        Category::query()->create([
            'title' => $request->input('title'),
            'parent_id' => $request->input('parent_id'),
            'image' => $image
        ]);

        return to_route('category.index')->with('success', 'دسته بندی با موفقیت ایجاد شد');
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
    public function edit( $id)
    {
        $title = 'ویرایش دسته بندی';
        $category = Category::query()->findOrFail($id);
        $categories = Category::query()->pluck('title', 'id');
        return view('admin.category.edit', compact('category', 'categories', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::query()->findOrFail($id);
        $image=$request->file? Category::saveImage($request->file): $category->image; ;
        $categories = Category::query()->pluck('title', 'id');
        $category->update([
           'title' => $request->input('title'),
           'parent_id' => $request->input('parent_id'),
           'image' => $image
        ]);

        return to_route('category.index')->with('success', 'دسته بندی با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return to_route('category.index')->with('success', 'دسته بندی با موفقیت حذف شد');
    }
}
