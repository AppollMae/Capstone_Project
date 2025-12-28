<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StructuralPermit extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_no',
        'csp_no',
        'building_permit_no',
        'owner_lastname',
        'owner_firstname',
        'owner_mi',
        'owner_tin',
        'form_ownership',
        'occupancy',
        'owner_no',
        'owner_street',
        'owner_barangay',
        'owner_city',
        'owner_zip',
        'owner_tel',
        'lot_no',
        'blk_no',
        'tct_no',
        'tax_dec_no',
        'construction_street',
        'construction_barangay',
        'construction_city',
        'scope',
        'scope_others',
        'scope_accessory',
    ];

    protected $casts = [
        'scope' => 'array'
    ];
}
