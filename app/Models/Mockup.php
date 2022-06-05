<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mockup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function mockupFiles()
    {
        return $this->hasMany(MockupFile::class);
    }

    public function config()
    {
        return $this->hasOne(MockupConfig::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
