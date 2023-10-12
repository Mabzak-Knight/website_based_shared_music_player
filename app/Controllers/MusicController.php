<?php

namespace App\Controllers;

use App\Models\MusicModel;
use App\Models\NowPlayingModel;

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

public function save()
{
    $model = new MusicModel();
    $data = [
        'judul' => $this->request->getPost('judul'),
        'artis' => $this->request->getPost('artis'),
        'album' => $this->request->getPost('album'),
        'file_musik' => $this->request->getFile('file_musik')->getName(), // Ambil nama file
    ];
    
    // Simpan data ke database
    $model->insert($data);

    // Pindahkan file ke direktori yang diinginkan
    $file = $this->request->getFile('file_musik');
    $file->move(ROOTPATH . 'public/uploads'); // Pindahkan ke folder uploads

    return redirect()->to(site_url('music'));
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
    $latestSongs = $nowPlayingModel->select('musik.judul, musik.file_musik')
                                   ->join('musik', 'musik.id = putar_sekarang.id_lagu')
                                   ->orderBy('putar_sekarang.waktu_putar', 'desc')
                                   ->limit(3)
                                   ->findAll();

    return $this->response->setJSON(['latestSongs' => $latestSongs]);
}





}
