<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\UniqueServiceCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\{ServiceCategory, Service};

class ServiceController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_category_id' => ['required', 'string', new UniqueServiceCategory],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back();
        }
        $validated = $validator->validated();

        // $upload_media = '';
        // if ($request->file('upload_media')) {
        //     $serviceFilePath = serviceFilePath();
        //     $upload_media = saveFile($serviceFilePath, $request->upload_media);
        // }

        $addService = new Service;
        // $addService->title = $request->title;
        // $addService->description = $request->description;
        // $addService->price = $request->price;
        // $addService->upload_media = $upload_media;
        $addService->service_category_id = $request->service_category_id;
        $addService->user_id = Auth::id();
        $addService->status = '0';

        if ($validator->fails()) {
            $errors = $validator->errors();

            foreach ($errors->all() as $error) {
                toastr()->error($error);
            }

            return redirect()->back()->withInput();
        }

        if ($addService->save()) {
            toastr('Service Added Successfully!');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $serviceDetails = Service::with('serviceCategory')->find($id);
        return response()->json([
            'status' => true,
            'serviceDetails' => $serviceDetails
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'service_category_id' => ['required', 'string', new UniqueServiceCategory('edit-form', $id)],
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back();
        }
        $validated = $validator->validated();

        $updateService = Service::find($id);

        // $upload_media = $updateService->upload_media ?? '';
        // if ($request->file('upload_media')) {
        //     $serviceFilePath = serviceFilePath();
        //     $upload_media = saveFile($serviceFilePath, $request->upload_media);
        // }

        // $updateService->title = $request->title;
        // $updateService->description = $request->description;
        // $updateService->price = $request->price;
        // $updateService->upload_media = $upload_media;

        $updateService->service_category_id = $request->service_category_id;
        $updateService->user_id = Auth::id();

        if ($updateService->save()) {
            toastr('Service Updated Successfully!');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $service = Service::find($id);
        $file = public_path($service->upload_media);
        if ($service->delete()) {
            if (file_exists($file)) {
                @unlink($file);
            }
            toastr('Service Deleted Successfully!');
            return redirect()->back();
        }
    }
}
