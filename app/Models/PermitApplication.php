<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitApplication extends Model
{
    protected $fillable = [
        'project_name',
        'location',
        'address',       // NEW
        'latitude',      // NEW
        'longitude',     // NEW
        'description',
        'documents'
    ];
    protected $casts = [
        'documents' => 'array', // Automatically cast JSON to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
