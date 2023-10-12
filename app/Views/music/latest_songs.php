<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>3 Judul Lagu Terbaru</title><link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Music App</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="/music">
                    <button type="button" class="btn btn-dark btn-lg">
                        <i class="fas fa-music"></i> Daftar Musik
                    </button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/music/streaming">
                    <button type="button" class="btn btn-dark btn-lg">
                        <i class="fas fa-play"></i> Streaming
                    </button>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/music/input">
                    <button type="button" class="btn btn-dark btn-lg">
                        <i class="fas fa-plus"></i> Input Musik
                    </button>
                </a>
            </li>
        </ul>
    </div>
</nav>

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
   <script>
    var audioPlayer = document.getElementById('audioPlayer');
    var playlist = [];
    var currentSongIndex = 0;
    var isPlaying = false;

    function loadLatestSongs() {
        $.ajax({
            url: '<?= site_url('music/latest-songs-json') ?>',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                const latestSongs = response.latestSongs;
                const listElement = $('#latestSongsList');
                listElement.empty();

                playlist.forEach(function (song, index) {
                    var listItem = $('<li class="list-group-item"></li>').text(song.judul);
                    if (index === currentSongIndex && isPlaying) {
                        // Tandai lagu yang sedang diputar dengan ikon putar musik
                        listItem.prepend('<i class="fas fa-music mr-2"></i>');
                    }
                    listElement.append(listItem);
                });

                if (JSON.stringify(latestSongs) !== JSON.stringify(playlist)) {
                    // Jika daftar putar berubah, perbarui daftar putar dan putar musik baru
                    playlist = latestSongs;

                    // Memastikan lagu pertama dimainkan saat halaman dibuka atau daftar putar diperbarui
                    playSong(currentSongIndex);
                }
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
