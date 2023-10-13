<?php

namespace App\Controllers;

use App\Models\MusicModel;
use App\Models\NowPlayingModel;
use getID3;

class MusicController extends BaseController
{
public function index()
{
    $model = new MusicModel();

    $searchTerm = $this->request->getVar('search');

    if ($searchTerm) {
        $data['music'] = $model->like('judul', $searchTerm)
                              ->orLike('artis', $searchTerm)
                              ->orLike('album', $searchTerm)
                              ->findAll();
    } else {
        $data['music'] = $model->findAll();
    }

    return view('music/index', $data);
}


public function input()
    {
        return view('music/input');
    }

    public function deleteSong()
    {
        $nowPlayingModel = new NowPlayingModel();

        // Ambil ID lagu dari permintaan POST
        $songId = $this->request->getPost('songId');

        // Hapus lagu dari tabel putar_sekarang
        $deleted = $nowPlayingModel->delete($songId);

        if ($deleted) {
            // Jika penghapusan berhasil
            $response = ['success' => true];
        } else {
            // Jika terjadi kesalahan saat menghapus
            $response = ['success' => false];
        }

        return $this->response->setJSON($response);
    }

    public function save()
    {
        require_once 'path_to_getID3/getid3/getid3.php';
    
        $model = new MusicModel();
        $file = $this->request->getFile('file_musik');
    
        // Generate nama file baru berdasarkan timestamp
        $newFileName = time() . '_' . $file->getRandomName();
    
        // Pemeriksaan durasi file musik
        $getID3 = new getID3;
        $fileInfo = $getID3->analyze($file->getTempName());
        $duration = $fileInfo['playtime_seconds'];
        
        if ($duration <= 600) { // Durasi kurang dari atau sama dengan 10 menit (600 detik)
            // Pemeriksaan tipe file
            $audioFileType = $fileInfo['fileformat'];
            if (in_array($audioFileType, ['mp3', 'wav', 'ogg', 'flac'])) {
                // File adalah file musik yang didukung
    
                // Lanjutkan dengan menyimpan data ke database dan memindahkan file
                $data = [
                    'judul' => $this->request->getPost('judul'),
                    'artis' => $this->request->getPost('artis'),
                    'album' => $this->request->getPost('album'),
                    'file_musik' => $newFileName, // Gunakan nama file baru
                ];
                
                // Simpan data ke database
                $model->insert($data);
    
                // Pindahkan file ke direktori yang diinginkan
                $file->move(ROOTPATH . 'public/uploads', $newFileName);
    
                return redirect()->to(site_url('music'));
            } else {
                // File tidak didukung, tindakan yang sesuai
                echo "Tipe file tidak didukung. Mohon unggah file musik yang valid.";
            }
        } else {
            // File tidak memenuhi syarat, lakukan tindakan yang sesuai
            echo "File musik harus kurang dari atau sama dengan 10 menit.";
        }
    }
    


public function play($id)
{
    $model = new MusicModel();
    $music = $model->find($id);
    
    if (!$music) {
        // Handle jika lagu tidak ditemukan
    }

    // Lakukan tindakan pemutaran musik di sini
    
    return view('music/play', ['music' => $music]);
}

public function sendToStreaming($musicId)
{
    $model = new NowPlayingModel();
    $musicModel = new MusicModel();

    // Ambil data musik dari model MusicModel
    $music = $musicModel->find($musicId);

    if (!$music) {
        // Handle jika musik tidak ditemukan
        return $this->response->setJSON(['success' => false, 'message' => 'Musik tidak ditemukan']);
    }

    // Cek apakah lagu sudah ada dalam daftar putar
    $existingSong = $model->where('id_lagu', $musicId)->first();

    if ($existingSong) {
        // Jika lagu sudah ada, lakukan pembaruan waktu putar
        $model->update($existingSong['id'], ['waktu_putar' => date('Y-m-d H:i:s')]);
    } else {
        // Jika lagu belum ada, tambahkan ke daftar putar
        $data = [
            'id_lagu' => $musicId,
            'waktu_putar' => date('Y-m-d H:i:s') // Gunakan waktu saat ini
        ];
        $model->insert($data);
    }

    return $this->response->setJSON(['success' => true, 'message' => 'Musik berhasil ditambahkan']);
}


public function latestSongs()
{
    $nowPlayingModel = new NowPlayingModel();

    $latestSongs = $nowPlayingModel->select('musik.judul')
                                   ->join('musik', 'musik.id = putar_sekarang.id_lagu')
                                   ->orderBy('putar_sekarang.waktu_putar', 'desc')
                                   ->limit(3)
                                   ->findAll();

    return view('music/latest_songs', ['latestSongs' => $latestSongs]);
}

public function latestSongsJson()
{
    $nowPlayingModel = new NowPlayingModel();
    $latestSongs = $nowPlayingModel->select('musik.judul,musik.artis, musik.file_musik,putar_sekarang.id')
                                   ->join('musik', 'musik.id = putar_sekarang.id_lagu')
                                   ->orderBy('putar_sekarang.waktu_putar', 'desc')
                                   ->limit(3)
                                   ->findAll();

    return $this->response->setJSON(['latestSongs' => $latestSongs]);
}





}
