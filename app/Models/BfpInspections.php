<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BfpInspections extends Model
{
     protected $fillable = [
        'permit_id',
        'inspector_id',
        'inspection_date',
        'remarks',
        'result',
    ];

    protected $casts = [
        'inspection_date' => 'datetime',
    ];
    protected $table = 'bfp_inspections';
    use HasFactory;
}
