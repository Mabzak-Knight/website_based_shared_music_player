<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Input Tambah Musik</h2>
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
    </div>
</div>

    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
