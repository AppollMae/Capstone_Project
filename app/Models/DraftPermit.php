<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftPermit extends Model
{
    protected $fillable = [
        'user_id',
        'project_name',
        'location',
        'address',       // NEW
        'latitude',      // NEW
        'longitude',     // NEW
        'description',
        'documents',
        'status',
    ];

    protected $table = 'draft_permits';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function draftpermit(){
        return $this->hasOne(DraftPermit::class, 'user_id' , 'id');
    }

    use HasFactory;
}
