<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlumbingPermitPage2 extends Model
{
    protected $fillable = [
        'received_by',
        'received_date',
        'plan',
        'bom',
        'cost',
        'others',
        'progress_flow',
    ];

    protected $casts = [
        'plan' => 'boolean',
        'bom' => 'boolean',
        'cost' => 'boolean',
        'progress_flow' => 'array',
    ];
    use HasFactory;
}
