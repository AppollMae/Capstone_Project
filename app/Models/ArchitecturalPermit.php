<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitecturalPermit extends Model
{
    protected $fillable = [
        'application_no',
        'ap_no',
        'building_permit_no',
        'owner_last_name',
        'owner_first_name',
        'owner_middle_initial',
        'ownership_form',
        'occupancy_use',
        'address',
        'telephone',
        'scope',
        'architect_name',
        'architect_prc',
        'architect_ptr',
        'supervisor_name',
        'supervisor_prc',
        'building_owner_signature',
        'lot_owner_signature',
    ];

    protected $casts = [
        'scope' => 'array',
    ];
    use HasFactory;
}
