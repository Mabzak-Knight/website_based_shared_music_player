<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Musik</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body>
     <!-- Navbar -->
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
    <div class="container mt-5">
        <h2>Input Musik</h2>
        <form action="<?= site_url('music/save') ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-3">
                <label for="artis" class="form-label">Artis</label>
                <input type="text" class="form-control" id="artis" name="artis" required>
            </div>
            <div class="mb-3">
                <label for="album" class="form-label">Album</label>
                <input type="text" class="form-control" id="album" name="album" required>
            </div>
            <div class="mb-3">
                <label for="file_musik" class="form-label">File Musik</label>
                <input type="file" class="form-control" id="file_musik" name="file_musik" required accept=".mp3">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

    </div>
    
    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</body>
</html>
