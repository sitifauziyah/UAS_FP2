<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    // public $guarded = [];
    protected $table = "pegawais";
    protected $primaryKet = "id";
    protected $fillable = [
        'id', 'nip', 'nama_pegawai', 'alamat', 'gambar','public_id'
    ];

}
