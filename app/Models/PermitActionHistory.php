<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermitActionHistory extends Model
{

    protected $fillable = [
        'permit_id',
        'user_id',
        'action',
    ];

    protected $table = 'permit_action_histories';

    public function permit()
    {
        return $this->belongsTo(PermitApplication::class, 'permit_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // In PermitApplication.php model
   

    use HasFactory;
}
