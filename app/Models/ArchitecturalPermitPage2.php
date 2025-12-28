<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchitecturalPermitPage2 extends Model
{
    protected $fillable = [
        'received_by',
        'received_date',
        'documents',
        'documents_others',
        'issued_signature',
        'issued_date',
    ];

    protected $casts = [
        'documents' => 'array',
    ];

    public function progressFlows()
    {
        return $this->hasMany(ProcessFlow::class);
    }
    use HasFactory;
}
