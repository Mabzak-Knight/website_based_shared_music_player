<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SMP - Shared Music Player</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>
<body>
    <?php include('music/navbar.php'); ?>
    
<div class="container mt-5 text-center">
    <h1>Welcome to SMP - Shared Music Player</h1>
    <p>Share your favorite music with others online!</p>

    <a href="/music/streaming" class="btn btn-secondary btn-lg m-2 p-3 pr-4 pl-4 animate__animated animate__fadeIn">
        <i class="fas fa-play fa-4x mb-2"></i><br>
        Music Player
    </a>

    <a href="/music" class="btn btn-secondary btn-lg m-2 p-5 animate__animated animate__fadeIn">
        <i class="fas fa-music fa-4x mb-2"></i><br>
        Daftar Musik
    </a>


    <a href="/music/input" class="btn btn-secondary btn-lg m-2 p-3 animate__animated animate__fadeIn">
        <i class="fas fa-plus fa-4x mb-2"></i><br>
        Upload Musik
    </a>

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
</style>

<!-- ... Bagian sebelumnya ... -->

<div class="container mt-5 text-center">
    <!-- ... Tombol-tombol sebelumnya ... -->
    
    <div class="wave-container">
        <div class="wave"></div>
    </div>
</div>



</div>





    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
