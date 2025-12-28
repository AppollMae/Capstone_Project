<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessFlow extends Model
{
    protected $fillable = [
        'architectural_permit_id',
        'office_section',
        'in_date',
        'in_time',
        'out_date',
        'out_time',
        'processed_by',
    ];

    public function permit()
    {
        return $this->belongsTo(ArchitecturalPermit::class);
    }
    
    use HasFactory;
}
