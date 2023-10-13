<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List Music | SMP - Shared Music Player </title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
        .audio-container {
    position: relative;
    display: inline-block;
    margin: 10px 0;
}

.audio-controls {
    display: flex;
    align-items: center;
}

.audio-player {
    width: 100%;
    display: none;
}

.play-button {
    cursor: pointer;
    font-size: 24px;
    margin-right: 10px;
}

.play-button i {
    cursor: pointer;
}
.music-info {
    padding: 20px;
}

.info {
    font-size: 16px;
    font-weight: bold;
    color: #333;
}

.album {
    color: #007bff;
}

.artis {
    color: #28a745;
}

.judul {
    color: #dc3545;
}

.music-player {
    text-align: center;
}

.music-action {
    text-align: center;
}

.audio-container {
    display: inline-block;
}

.audio-controls {
    position: relative;
}

.audio-player {
    width: 100%;
}

.play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    cursor: pointer;
    font-size: 24px;
}


    </style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-5">
        <h2>Daftar Musik</h2>
        <div class="mb-3">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari Judul Lagu, Artis, atau Album">
        </div>
        <div class="table-responsive">
        <table class="table" id="musicTable">
    <thead>
        <tr>
            <th>Informasi Musik</th>
            <th>Pemutar Musik</th>
            <th>Kirim ke Streaming</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($music as $song): ?>
            <tr>
                <td class="music-info">
                    <div class="info">
                        <span class="album"><?= $song['album'] ?></span>
                        <span class="artis"><?= $song['artis'] ?></span>
                        <span class="judul"><?= $song['judul'] ?></span>
                    </div>
                </td>
                <td class="music-player">
                    <div class="audio-container">
                        <div class="audio-controls">
                            <audio class="audio-player" preload="none">
                                <source src="<?= base_url('uploads/' . $song['file_musik']) ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="play-button">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="music-action">
    <a href="javascript:void(0)" class="btn btn-primary send-to-streaming" data-musicid="<?= $song['id'] ?>">
        <i class="fas fa-music"></i> Request
    </a>
</td>

            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="streamingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pesan Streaming</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Musik sudah dikirim ke streaming. Tunggu beberapa detik sampai di putar oleh server.
      </div>
    </div>
  </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const playButtons = document.querySelectorAll('.play-button');
    
    playButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const audio = this.parentElement.querySelector('.audio-player');
            if (audio.paused) {
                audio.play();
                this.querySelector('i').classList.remove('fa-play');
                this.querySelector('i').classList.add('fa-pause');
            } else {
                audio.pause();
                this.querySelector('i').classList.remove('fa-pause');
                this.querySelector('i').classList.add('fa-play');
            }
        });
    });

    // Tambahkan event listener untuk tombol "Kirim ke Streaming"
    $('.send-to-streaming').click(function() {
        var musicId = $(this).data('musicid');

        $.ajax({
            url: '<?= site_url('music/send-to-streaming/') ?>' + musicId,
            type: 'GET',
            success: function(response) {
                if (response.success) {
                    // Tampilkan modal jika pengiriman berhasil
                    $('#streamingModal').modal('show');
                     // Jika ingin menutup modal setelah beberapa detik
                     setTimeout(function() {
                        $('#streamingModal').modal('hide');
                    }, 4000); // Tutup modal setelah 5 detik
                } else {
                    // Handle jika terjadi kesalahan
                    alert(response.message);
                }
            }
        });
    });
});
</script> 
<script>
        $(document).ready(function() {
            var table = $('#musicTable').DataTable();

            $('#searchInput').on('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
</body>
</html>
