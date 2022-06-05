<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MockupConfig extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function mockup()
    {
        return $this->belongsTo(Mockup::class);
    }
}
