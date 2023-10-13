<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SMP - Shared Music Player</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .wave-container {
            position: relative;
            height: 50px; /* Sesuaikan dengan tinggi gelombang */
            width: 100%;
            overflow: hidden;
        }

        .wave {
            position: absolute;
            width: 100%;
            height: 100%;
            bottom: 0;
            background: #007bff; /* Warna gelombang (sesuaikan dengan kebutuhan) */
            opacity: 0.5;
            transform-origin: bottom;
            animation: waveAnimation 1s infinite linear alternate;
        }

        @keyframes waveAnimation {
            0% {
                transform: scale(1, 0.9);
            }
            100% {
                transform: scale(1, 1.1);
            }
        }

        /* Tampilan desktop */
@media (min-width: 768px) {
  .mobile-buttons {
    display: none;
  }
  .desktop-buttons {
    display: block;
  }
}

/* Tampilan mobile */
@media (max-width: 767px) {
  .mobile-buttons {
    display: block;
  }
  .desktop-buttons {
    display: none;
  }
}

    </style>
</head>
<body>
    <?php include('music/navbar.php'); ?>
    
    <div class="container mt-5 text-center">
        <h1>Welcome to SMP - Shared Music Player</h1>
        <p>Share your favorite music with others online!</p>

        <!-- Tombol Music Player (Desktop) -->
<div class="desktop-buttons">
  <a href="/music/streaming" class="btn btn-secondary btn-lg m-2 p-3 pr-4 pl-4 animate__animated animate__fadeIn">
    <i class="fas fa-play fa-4x mb-2"></i><br>
    Music Player
  </a>

  <!-- Tombol Daftar Musik (Desktop) -->
  <a href="/music" class="btn btn-secondary btn-lg m-2 p-5 animate__animated animate__fadeIn">
    <i class="fas fa-music fa-4x mb-2"></i><br>
    Daftar Musik
  </a>

  <!-- Tombol Upload Musik (Desktop) -->
  <a href="/music/input" class="btn btn-secondary btn-lg m-2 p-3 animate__animated animate__fadeIn">
    <i class="fas fa-plus fa-4x mb-2"></i><br>
    Upload Musik
  </a>
  <br>  <br>  <br>  <br>  <br>  <br>
</div>

<!-- Tombol Music Player (Mobile) -->
<div class="mobile-buttons">
  <a href="/music/streaming" class="btn btn-secondary btn-lg m-2 p-3 animate__animated animate__fadeIn d-flex align-items-center">
    <i class="fas fa-play fa-4x mr-2"></i> Music Player
  </a>

  <!-- Tombol Daftar Musik (Mobile) -->
  <a href="/music" class="btn btn-secondary btn-lg m-2 p-3 animate__animated animate__fadeIn d-flex align-items-center">
    <i class="fas fa-music fa-4x mr-2"></i> Daftar Musik
  </a>

  <!-- Tombol Upload Musik (Mobile) -->
  <a href="/music/input" class="btn btn-secondary btn-lg m-2 p-3 animate__animated animate__fadeIn d-flex align-items-center">
    <i class="fas fa-plus fa-4x mr-2"></i> Upload Musik
  </a>
</div>


        <div class="wave-container mt-4">
    <div class="wave"></div>
</div>

<div class="container mt-5 text-center credit">
    <p>By Al Khoir Khoir</p>
    <p><a href="https://github.com/Mabzak-Knight/website_based_shared_music_player">Sumber Kode</a></p>
</div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
