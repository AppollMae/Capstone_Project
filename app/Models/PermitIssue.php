<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitIssue extends Model
{
    protected $fillable = [
        'permit_id',
        'user_id',
        'issue',
        'reported_by'
    ];
    protected $table = 'issue_permit_flags';

    public function permit()
    {
        return $this->belongsTo(PermitApplication::class, 'permit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function permitApplication()
    {
        return $this->belongsTo(PermitApplication::class, 'permit_id');
    }

    // Relation to User
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    use HasFactory;
}
