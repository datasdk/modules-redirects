<?php

namespace Modules\Redirect\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceRedirect extends Model
{
    use HasFactory;

    protected $fillable = ['name','platform', 'url'];
}