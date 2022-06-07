<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockupFile extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        return asset($this->path);
    }

    public function mockup()
    {
        return $this->belongsTo(Mockup::class);
    }
}
