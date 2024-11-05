<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $title = 'لیست رنگ ها';
        return view('admin.color.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد رنگ';
        return view('admin.color.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorRequest $request)
    {
        Color::query()->create([
            'title' => $request->input('title'),
            'code' => $request->input('code'),
        ]);

        return to_route('colors.index')->with('success', 'رنگ با موفقیت ایجاد شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $color = Color::query()->findOrFail($id);
        $title = 'ویرایش رنگ';

        return view('admin.color.edit', compact('title', 'color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ColorRequest $request, string $id)
    {
        $color = Color::query()->find($id);
        $color->update([
            'title' => $request->input('title'),
            'code' => $request->input('code'),
        ]);

        return to_route('colors.index')->with('success', 'رنگ با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Color::destroy($id);
        return to_route('colors.index')->with('success', 'رنگ با موفقیت حذف شد');
    }
}
