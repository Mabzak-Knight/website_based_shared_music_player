<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Putar Musik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
</head>
<body>
    <audio controls>
        <source src="<?= base_url('uploads/' . $music['file_musik']) ?>" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script src="<?= base_url('js/bootstrap.min.js') ?>"></script>
</body>
</html>
