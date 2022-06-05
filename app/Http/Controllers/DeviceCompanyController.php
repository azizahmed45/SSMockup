<?php

namespace App\Http\Controllers;

use App\Models\DeviceCompany;
use Illuminate\Http\Request;

class DeviceCompanyController extends Controller
{
    public function getDevices(DeviceCompany $company)
    {
        return $company->devices;
    }
}
