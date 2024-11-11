<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyGroup;
use Illuminate\Http\Request;

class PropertyGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'لیست گروه ویژگی ها';
        return view('admin.property_group.list', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد گروه ویژگی ها';
        return view('admin.property_group.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        PropertyGroup::query()->create([
           'title'=>$request->input('title')
        ]);

        return to_route('property_groups.index')->with('success', 'گروه ویژگی ها با موفقیت ایجاد شد');
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
        $title = 'ویرایش گروه ویژکی ها';
        $property_group = PropertyGroup::query()->findOrFail($id);
        return view('admin.property_group.edit', compact('title', 'property_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $propertyGroup = PropertyGroup::query()->find($id);
        $propertyGroup->update([
            'title' => $request->input('title')
        ]);

        return to_route('property_groups.index')->with('success', 'گروه ویژگی‌ها با موفقیت ویرایش شد');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $propertyGroup = PropertyGroup::query()->findOrFail($id);
        $propertyGroup->delete();

        return to_route('property_groups.index')->with('success', 'گروه ویژگی ها با موفقیت حذف شد');
    }
}