<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Steaming | SMP - Shared Music Player </title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    
    
    <style>
        audio {
            width: 100%;
        }
        .card img {
    max-width: 100px; /* Sesuaikan dengan ukuran yang diinginkan */
    max-height: 100px; /* Sesuaikan dengan ukuran yang diinginkan */
    display: block;
    margin: auto;
}

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container-xl pt-4">
      <div class="card">
        <div class="card-body d-flex align-items-center">
            <div class="mr-4">
                <img src="<?= base_url('music.gif') ?>" alt="Music Icon" class="img-fluid">
            </div>
            <div class="flex-grow-1">
                <audio id="audioPlayer" controls autoplay>
                    <!-- Sumber audio akan diperbarui melalui JavaScript -->
                </audio>
            </div>
        </div>
    </div>
    
<div class="card">
    <div class="card-body">       
    <div class="custom-control custom-switch">
        <input checked type="checkbox" class="custom-control-input" id="autoPlaySwitch">
        <label class="custom-control-label" for="autoPlaySwitch">Putar otomatis musik baru</label>
    </div>

    </div>
</div>
    <div class="card mt-4">
    <div class="card-body">
        <div class="container">
            <h2 class="text-center">Playlist</h2>
            <ul class="list-group list-group-flush shadow p-3 mb-5 bg-white rounded" id="latestSongsList">
                <!-- Data terbaru akan dimuat di sini secara dinamis -->
            </ul>

        </div>
    </div>
</div>

</div>


    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <script>
    var audioPlayer = document.getElementById('audioPlayer');
    var playlist = [];
    var currentSongIndex = 0;
    var isPlaying = false;
    var cPlaying = true;
    var autoPlaySwitch = document.getElementById('autoPlaySwitch');


    function loadLatestSongs() {
    $.ajax({
        url: '<?= site_url('music/latest-songs-json') ?>',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const latestSongs = response.latestSongs;
            const listElement = $('#latestSongsList');
            listElement.empty();

            autoPlaySwitch.addEventListener('change', function() {
                cPlaying = this.checked;
            });

            playlist.forEach(function (song, index) {
    var listItem = $('<li class="list-group-item d-flex justify-content-between align-items-center"></li>');

    var songInfo = $('<div></div>'); // Membuat div untuk menyimpan informasi lagu
    var title = $('<span class="font-weight-bold"></span>').text(song.judul); // Judul lagu
    var artist = $('<span class="ml-2"></span>').text(song.artis); // Artis lagu

    songInfo.append(title);
    songInfo.append(artist);

    if (index === currentSongIndex && isPlaying) {
        // Jika lagu sedang diputar, tambahkan ikon musik
        title.prepend('<i class="fas fa-music mr-2"></i>');
    }

    var deleteButton = $('<button class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>');

    deleteButton.click(function() {
        deleteSong(index);
    });

    listItem.append(songInfo);
    listItem.append(deleteButton);

    listElement.append(listItem);
});


            //jika ada musik baru di masukkan
            if (JSON.stringify(latestSongs) !== JSON.stringify(playlist)) {
                // Jika daftar putar berubah, perbarui daftar putar dan putar musik baru
                playlist = latestSongs;
                if (cPlaying) {
                    var currentSong = playlist[currentSongIndex];
                    if (currentSong && currentSong.id === parseInt(audioPlayer.dataset.currentMusicId)) {
                        // Putar ulang musik jika musik baru adalah yang sedang diputar           
                        audioPlayer.currentTime = 0;
                        audioPlayer.play();
                    } else {
                        currentSongIndex=0;
                        playSong(currentSongIndex);
                    }
                } else {
                    if (currentSongIndex < playlist.length) {
                        if (currentSong && currentSong.id === parseInt(audioPlayer.dataset.currentMusicId)) {
                            currentSongIndex = 0;
                        }else{
                            currentSongIndex++;
                        }
                    } else {
                        currentSongIndex = 0;
                    }
                }
            }
        }
    });
}
function deleteSong(index) {
    var songId = playlist[index].id; // Ambil ID lagu dari playlist

    console.log('Menghapus lagu dengan ID: ' + songId); // Menampilkan pesan input

    $.ajax({
        url: '<?= site_url('music/delete-song') ?>', // Ganti dengan URL yang sesuai
        type: 'POST',
        dataType: 'json',
        data: { songId: songId },
        success: function(response) {
            if (response.success) {
                console.log('Lagu berhasil dihapus'); // Menampilkan pesan output sukses
                playlist.splice(index, 1);
                if (index === currentSongIndex && isPlaying) {
                    audioPlayer.pause();
                    isPlaying = false;
                }
                loadLatestSongs();
            } else {
                console.error('Gagal menghapus lagu'); // Menampilkan pesan output gagal
                alert('Gagal menghapus lagu');
            }
        },
        error: function() {
            console.error('Terjadi kesalahan saat menghubungi server'); // Menampilkan pesan error
            alert('Terjadi kesalahan saat menghubungi server');
        }
    });
}



    function playSong(index) {
        var song = playlist[index];
        audioPlayer.src = '<?= base_url('uploads/') ?>' + song.file_musik;
        audioPlayer.play();
        isPlaying = true;

        // Perbarui tampilan daftar putar untuk menandai lagu yang sedang diputar
        loadLatestSongs();
    }

    //musik selanjutnya jika sudah selesai
    audioPlayer.onended = function () {
        currentSongIndex++;
        if (currentSongIndex < playlist.length) {
            playSong(currentSongIndex);
        } else {
            currentSongIndex = 0;
            playSong(currentSongIndex);
        }
    };

    // Fungsi untuk memperbarui playlist secara berkala
    function updatePlaylist() {
        loadLatestSongs();
    }

    // Memulai pemutaran pertama
    updatePlaylist();

    // Memperbarui playlist setiap 10 detik
    setInterval(updatePlaylist, 10000);
</script>


</body>
</html>
