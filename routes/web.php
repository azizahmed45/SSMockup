<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/mockup', \App\Http\Controllers\MockupController::class);

Route::get('/test', function () {


    $deviceCompany = \App\Models\DeviceCompany::create([
        'name' => 'Apple',
        'logo' => 'Apple.png',
    ]);

    $mockupDevice = \App\Models\Device::create([
        'name' => 'Test',
        'variant' => 'Test',
        'model' => 'Test',
        'description' => 'Test',
        'thumbnail' => 's21.jpg',
        'device_company_id' => $deviceCompany->id,
    ]);


    $mockup = \App\Models\Mockup::create([
        'name' => 'S21 Ultra',
        'description' => 'Test Description',
        'device_id' => $mockupDevice->id,
    ]);

    $mockupConfig =  \App\Models\MockupConfig::create([
        'left' => 100,
        'top' => 100,
        'bottom' => 100,
        'right' => 100,
        'mockup_id' => $mockup->id,
    ]);

    $mockupFile = \App\Models\MockupFile::create([
        'name' => 'S21 Ultra',
        'path' => 's21.jpg',
        'mockup_id' => $mockup->id,
    ]);


//    return \App\Models\Mockup::query()->with(['device', 'mockupFiles', 'mockupConfig'])->get();

});
