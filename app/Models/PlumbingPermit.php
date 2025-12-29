<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlumbingPermit extends Model
{
    protected $fillable = [
        'application_no',
        'pp_no',
        'building_permit_no',
        'last_name',
        'first_name',
        'middle_initial',
        'tin',
        'ownership',
        'occupancy',
        'address',
        'telephone',
        'scope_of_work',
        'scope_others',
        'fixtures',
        'designer_name',
        'designer_prc',
        'designer_ptr',
        'supervisor_name',
        'supervisor_prc',
        'owner_signature',
        'lot_owner_signature',
    ];

    protected $casts = [
        'scope_of_work' => 'array',
        'fixtures' => 'array',
    ];
    use HasFactory;
}
