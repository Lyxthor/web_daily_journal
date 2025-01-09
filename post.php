<?php
include 'koneksi.php';
session_start(); // Mulai session untuk mengecek apakah pengguna sudah login
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Diary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
    
</head>
<body class="font-poppins">
    <nav class="navbar navbar-expand-lg bg-light sticky-top px-2 py-4">
        <div class="container">
            <b class="navbar-brand fs-5" href="/index.php">MY DIARY</b>
            <!-- Tombol Login dan Hamburger -->
            <div class="d-flex align-items-center">
                <!-- Tombol Hamburger -->
                <button class="navbar-toggler me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>  
            </div>
            <!-- Menu Navbar -->
            <div class="collapse navbar-collapse ms-md-0" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link fs-6" href="#home">Home</a>
                    <a class="nav-link fs-6" href="#artikel">Article</a>
                    <a class="nav-link fs-6" href="#galeri">Gallery</a>
                    <a class="nav-link fs-6" href="#schedule">Schedule</a>
                    <a class="nav-link fs-6" href="#profile">Profile</a>
                </div>
            </div>

            <!-- Login atau Gambar User -->
            <div class="d-flex align-items-center ">
                <?php if (isset($_SESSION['username'])): ?>
                    <!-- Jika sudah login -->
                    <div class="dropdown">
                        <a href="#" class="nav-link d-block" data-bs-toggle="dropdown" aria-expanded="false"  style="width: 50px; height: 50px;">
                            <img src="foto/gambar login.png" class="rounded-circle object-cover img-fluid" alt="User">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a href="logout.php" class="btn btn-danger fs-6 px-4">Logout</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Jika belum login -->
                    <a href="login.php" class="btn btn-primary fs-6 px-4 fw-medium">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <?php 
    require "koneksi.php";
    $hasil;
    $post;
    $postId = isset($_GET["post_id"]) ? $_GET["post_id"] : null;
    if($postId != null)
    {
        $sql = "SELECT * FROM article WHERE id=$postId";
        $hasil = $conn->query($sql);
        if($hasil->num_rows == 0) return;
        $post = $hasil->fetch_assoc();
    }
    ?>
    <?php if(isset($post)) 
    {
    ?>
        <section class="container">
            <div class="row justify-content-center py-5">
                <div class="col-8">
                    <h1 class="fw-bold">
                        <?= $post['judul'] ?>
                    </h1>
                    <div class="info text-secondary small mb-3">
                        Diposting pada <?= date("j F Y", strtotime($post['tanggal'])) ?>, 
                        pukul <?= date("H:i", strtotime($post['tanggal'])) ?>
                        oleh <?= $post['username'] ?>
                    </div>
                    <div class="w-100 ratio ratio-16x9 mb-4">
                        <img src="foto/<?= $post['gambar'] ?>" alt="" class="img-fluid rounded rounded-lg">
                    </div>
                    
                    
                    <div class="content">
                        <p id="post-content"  class="fw-light lh-lg" style="text-align: justify;">
                            <span id="first-word" class="font-poppins-bold fw-bold fs-1 text-uppercase">

                            </span>
                            <?= $post['isi'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>
    <?php 
    } 
    ?>

      

      


    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        const contentEl = document.getElementById('post-content');
        const firstWordEl = document.getElementById("first-word");
        const contentText = contentEl.textContent.trim().split(" ");
        const firstWord = contentText[0];
        const contentHtml = contentEl.innerHTML;
        
        console.log(firstWordEl);
        firstWordEl.textContent = firstWord;
        contentEl.innerHTML = " "+contentText.slice(1, contentText.length).join(" ");
        contentEl.prepend(firstWordEl);
        //console.log(contentEl.textContent);
    </script>
  </body>
</html>