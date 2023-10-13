<?php

namespace App\Models;

use CodeIgniter\Model;

class NowPlayingModel extends Model
{
    protected $table = 'putar_sekarang'; // Sesuaikan dengan nama tabel di database Anda
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_lagu', 'waktu_putar'];

    // Fungsi untuk menghapus lagu dari tabel putar_sekarang berdasarkan ID
    public function deleteSong($id)
    {
        return $this->where('id', $id)->delete();
    }
    // Metode lain sesuai kebutuhan
}
