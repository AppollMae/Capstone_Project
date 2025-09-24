<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BfpInspector extends Model
{
    protected $fillable = [
        'inspector_name',
        'badge_number',
        'email',
        'phone',
        'station',
        'role',
        'password',
        'is_active',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $table = 'bfp_inspector';
    protected $guard = 'inspector';
    use HasFactory;
}
