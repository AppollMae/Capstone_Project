<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitApplication extends Model
{
    protected $fillable = [
        'user_id',
        'project_name',
        'location',
        'address',       // NEW
        'latitude',      // NEW
        'longitude',     // NEW
        'radiusRange',   // NEW
        'project_cost',  // NEW
        'description',
        'documents',
        'status',
        'avatar',
        'seen'
    ];
    protected $casts = [
        'documents' => 'array', // Automatically cast JSON to array
        'seen' => 'boolean',
    ];

    protected $table = "permit_applications";

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }

    public function issues()
    {
        return $this->hasMany(PermitIssue::class, 'permit_id');
    }

    public function issueFlags()
    {
        return $this->hasMany(PermitIssue::class, 'user_id', 'id');
    }

    public function location()
    {
        return $this->hasOne(PermitApplication::class, 'permit_application_id');
    }

    use HasFactory;
}
