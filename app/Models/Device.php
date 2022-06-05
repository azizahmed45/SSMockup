<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(DeviceCompany::class);
    }

    public function mockups()
    {
        return $this->hasMany(Mockup::class);
    }
}
