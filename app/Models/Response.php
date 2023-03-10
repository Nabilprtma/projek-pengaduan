<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Warga;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'warga_id',
        'status',
        'pesan',
    ];

    public function warga()
    {
        return $this->belongsTo
        (Warga::class);
    }
}
