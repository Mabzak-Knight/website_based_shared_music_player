<?php

namespace App\Models;

use CodeIgniter\Model;

class NowPlayingModel extends Model
{
    protected $table = 'putar_sekarang';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_lagu', 'waktu_putar'];

    // Metode lain sesuai kebutuhan
}
