<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Response;


class Warga extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'telepon',
        'pengaduan',
        'gambar',
    ];

    public function response()
    {
        return $this->hasOne
        (Response::class);
    }
}
