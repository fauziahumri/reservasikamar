<?php
    $path = $_SERVER['REQUEST_URI'];
    $title = '';

    if(strpos($path, '/reservasikamar') >= 0) {
        $title = 'bumbiw.';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/reservasikamar/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/reservasikamar/assets/css/style.css">
    <script src="/reservasikamar/assets/js/bootstrap.bundle.min.js"></script>
</head>
<body>