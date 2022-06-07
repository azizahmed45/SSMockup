<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\DeviceCompany;
use App\Models\Mockup;
use App\Models\MockupConfig;
use App\Models\MockupFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MockupController extends Controller
{
    public function create()
    {
        $companies = DeviceCompany::all();
        return view('mockup.create', compact('companies'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'mockupConfig' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',
        ]);

        DB::transaction(function () use ($request) {
            $device = Device::query()->findOrFail($request->device);

            $mockup = $device->mockups()->save(new Mockup([
                'name' => $request->name,
                'description' => $request->description,
            ]));

            $mockup->config()->save(new MockupConfig([
                'top' => $request->mockupConfig['top'],
                'bottom' => $request->mockupConfig['bottom'],
                'left' => $request->mockupConfig['left'],
                'right' => $request->mockupConfig['right'],
            ]));

            //save file from request
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            //unique file name generate
            $fileName = uniqid() . '_' . $fileName;
            $file->move(public_path('mockups'), $fileName);

            $mockup->mockupFiles()->save(new MockupFile([
                'name' => $fileName,
                'path' => '/mockups/' . $fileName,
            ]));
        });
    }

    public function getAllMockups()
    {
        return  Mockup::query()->with(['mockupFiles', 'config'])->latest()->paginate(5);
    }

    public function downloadMockupFile(MockupFile $mockupFile)
    {
        $downloadFile = public_path($mockupFile->path);
        return response()->download($downloadFile);
    }
}
