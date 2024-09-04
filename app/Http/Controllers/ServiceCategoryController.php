<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\Auth;

class ServiceCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            'category_amount' => 'required|numeric',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            // $imagePath = null;
            // if ($request->hasFile('image')) {
            //     $image = $request->file('image');
            //     $filename = time() . '_' . date('Ymd') . '_' . $image->getClientOriginalName();

            //     if (!Storage::disk('public')->exists('service_categories')) {
            //         Storage::disk('public')->makeDirectory('service_categories');
            //     }

            //     $imagePath = $image->storeAs('service_categories', $filename, 'public');
            // }

            $create = ServiceCategory::create([
                'name' => $request->category_name,
                // 'description' => $request->description,
                'user_id' => Auth::id(),
                'price' => $request->category_amount,
                // 'image' => $imagePath,
            ]);

            toastr('Category Added Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr("Something Went Wrong");
            return redirect()->back();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categoryDetails = ServiceCategory::find($id);
        return response()->json([
            "status" => true,
            "categoryDetails" => $categoryDetails
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            // 'description' => 'nullable|string',
            'category_amount' => 'required|numeric',
            // 'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $serviceCategory = ServiceCategory::findOrFail($id);

            // $imagePath = $serviceCategory->image;
            // if ($request->hasFile('image')) {
            //     if ($serviceCategory->image) {
            //         Storage::disk('public')->delete($serviceCategory->image);
            //     }
            //     $image = $request->file('image');
            //     $filename = time() . '_' . date('Ymd') . '_' . $image->getClientOriginalName();
            //     $imagePath = $image->storeAs('service_categories', $filename, 'public');
            // }

            $serviceCategory->update([
                'name' => $request->category_name,
                // 'description' => $request->description,
                'price' => $request->category_amount,
                // 'image' => $imagePath,
            ]);

            toastr('Category Updated Successfully!');
            return redirect()->back();
        } catch (\Exception $e) {
            toastr("Something Went Wrong");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $categoryDetails = ServiceCategory::find($id);
        if ($categoryDetails->delete()) {
            toastr('Category Deleted Successfully!');
            return redirect()->back();
        }
    }
}
