<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'title', 'description'];


    protected static function boot()
    {
        parent::boot();
        static::updating(function ($model) {
            if ($model->isDirty('icon') && ($model->getOriginal('icon') !== null)) {
                Storage::disk('public')->delete($model->getOriginal('icon'));
            }
        });
    }
}
