<?php
    const ROOT = __DIR__;
    const DB_USERS = ROOT . '/db/users.json';
    const STORAGE = ROOT . '/storage';
    const FILENAME_LENGTH = 16;

    require_once ROOT . '/services/authService.php';

    session_start();
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gallery</title>

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/main.css">
</head>

<body>
    <div class="container">
        <!--menu-->
        <div class="row mb-4">
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="index.php?page=gallery">Gallery</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=registration">Registration</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?page=login">Login</a>
                            </li>
                            <?php if(checkAuth()): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=upload">Upload</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?page=gallery">Gallery</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?script=logout">Logout</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <!--content-->
        <div class="row justify-content-center">
            <?php

            if (isset($_GET['script'])) {
                switch($_GET['script']) {
                    case 'logout':
                        require_once './scripts/logout.php';
                        break;
                    default:
                        require_once './pages/404.php';
                }
            }



            $privatePages = [
                'upload',
                'gallery',
            ];




            if(isset($_GET['page'])) {
                $page = $_GET['page'];

                if (in_array($page, $privatePages) && !checkAuth())
                    header('Location: index.php?page=login');

                switch ($page) {
                    case 'registration':
                        require_once './pages/registration.php';
                        break;
                    case 'login':
                        require_once './pages/login.php';
                        break;
                    case 'upload':
                        require_once './pages/upload.php';
                        break;
                    case 'gallery':
                        require_once './pages/gallery.php';
                        break;
                    default:
                        require_once './pages/404.php';
                }
            }
            ?>
        </div>
    </div>

<script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>