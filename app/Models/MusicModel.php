<?php

namespace App\Models;

use CodeIgniter\Model;

class MusicModel extends Model
{
    protected $table = 'musik';
    protected $primaryKey = 'id';
    protected $allowedFields = ['judul', 'artis', 'album', 'file_musik'];

    public function getMusic($id = null)
    {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->find($id);
    }

    public function insertMusic($data)
    {
        return $this->insert($data);
    }

    public function updateMusic($id, $data)
    {
        return $this->update($id, $data);
    }

    public function deleteMusic($id)
    {
        return $this->delete($id);
    }
}
