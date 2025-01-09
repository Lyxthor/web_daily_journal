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

      <section id="home" class="hero py-5 mb-5">
        <div class="container h-100">
          <div class="row justify-content-between align-items-center h-100">
            <div class="col-lg-6">
              <h1 class="display-4 font-poppins-bold mb-3">Welcome to My Diary</h1>
              <p class="mb-4 fw-light text-secondary">
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Laborum ullam rerum dolorem aliquid dignissimos impedit nesciunt, maiores harum labore, odio unde distinctio vero quia. Ut esse accusamus laborum. Minus, amet.
              </p>
              <b>#KELAS UNGGULAN</b>
            </div>
      
            <div class="col-lg-5">
              <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="foto/5.jpg" class="d-block w-100 rounded" alt="Image 1">
                  </div>
                  <div class="carousel-item">
                    <img src="foto/6.jpg" class="d-block w-100 rounded" alt="Image 2">
                  </div>
                  <div class="carousel-item">
                    <img src="foto/7.jpg" class="d-block w-100 rounded" alt="Image 3">
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- article begin -->
<section id="article" class="p-5">
  <div class="container">
    <h1 class="fw-bold display-6 pb-3 py-5 text-center">Article</h1>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <?php
      $sql = "SELECT * FROM article ORDER BY tanggal DESC";
      $hasil = $conn->query($sql); 

      while($row = $hasil->fetch_assoc()){
      ?>
        <div class="col">
          <div class="card rounded rounded-3 h-100">
            <div class="card-img-top ratio ratio-4x3">
              <img src="foto/<?= $row["gambar"]?>" class="card-img-top" alt="..." />
            </div>
            <div class="card-body px-4 py-4">
              <div class="small text-xs text-secondary">
                <?= $row['username'] ?>
              </div>
              <h5 class="card-title fw-bold fs-3 mt-1 mb-3">
                <?= $row["judul"]?>
              </h5>
              <p class="card-text small font-montserrat text">
                <?= substr_replace($row["isi"], "...", 200)?>
              </p>
              
            </div>
            <div class="card-footer bg-transparent border-0 px-4 py-4">
              <div class="w-full d-flex justify-content-between align-items-center">
                <div class="small text-secondary">
                  <?= date("j F Y", strtotime($row['tanggal'])) ?>
                </div>
                <a href="post.php?post_id=<?= $row['id'] ?>">Read More</a>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?> 
    </div>
  </div>
</section>
<!-- article end -->
      
      <section>
        <div class="container py-5 rounded" id="galeri">
          <h2 class="text-center mb-4">Gallery</h2>
          <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <?php 
          
              $sql = "SELECT * FROM gallery";
              $hasil = $conn->query($sql);
              ?>
              <?php if($hasil->num_rows == 0) : ?>
                  <div class="text-center">
                      Belum ada foto di gallery
                  </div>
              <?php else : ?>
                  <?php $gallery = $hasil->fetch_assoc() ?>
                  <div class="carousel-item active">
                    <div class="w-full ratio ratio-16x9">
                      <img src="foto/<?= $gallery['gambar'] ?>" class="h-100 object-fit-cover rounded" alt="Gallery Image 1">
                    </div>
                  </div>
                  <?php while($gallery = $hasil->fetch_assoc()) : ?>
                    <div class="carousel-item">
                      <div class="w-full ratio ratio-16x9">
                        <img src="foto/<?= $gallery['gambar'] ?>" class="h-100 object-fit-cover rounded" alt="Gallery Image 1">
                      </div>
                    </div>
                  <?php endwhile ?>
              <?php endif ?>
              
              
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </section>

      <section id="schedule" class="py-5 bg-light-subtle" >
        <br><br>

        <h2 class="text-center mb-4">Jadwal Kuliah & Kegiatan Mahasiswa</h2>        
        <div class="container">
          <div class="row text-center justify-content-center">
            <div class="col-md-1 col-lg-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-danger text-white">
                  <p>Senin</p>
                </div>

                <div class="card-body text-center">
                  <b>09.00-10.30</b>
                  <p>Basis Data</p>
                  <p>Ruang H.3.4</p>
                </div>

                
                <div class="card-body text-center">
                  <b>13.00-15.00</b>
                  <p>Dasar Pemrograman</p>
                  <p>Ruang H.3.1</p>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-lg-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-primary text-white">
                  <p>Selasa</p>
                </div>

                <div class="card-body text-center">
                  <b>08.00-09.30</b>
                  <p>Pemrograman Berbasis Web</p>
                  <p>Ruang D.2.J</p>
                </div>

                
                <div class="card-body text-center">
                  <b>14.00-16.00</b>
                  <p>Basis Data</p>
                  <p>Ruang D.3.M</p>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-lg-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-warning text-white">
                  <p>Rabu</p>
                </div>

                <div class="card-body text-center">
                  <b>10.00-12.00</b>
                  <p>Pemrograman Berbasis Object</p>
                  <p>Ruang D.2.A</p>
                </div>

                
                <div class="card-body text-center">
                  <b>13.30-15.00</b>
                  <p>Probabilitas</p>
                  <p>Ruang H.4.5</p>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-lg-3 mb-4">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-info text-white">
                  <p>Kamis</p>
                </div>

                <div class="card-body text-center">
                  <b>08.00-10.00</b>
                  <p>Pengantar Teknologi Informasi</p>
                  <p>Ruang D.3.N</p>
                </div>

                
                <div class="card-body text-center">
                  <b>11.00-13.00</b>
                  <p>Rapat Kordinasi Doscom</p>
                  <p>Ruang Rapat D.3</p>
                </div>
              </div>
            </div>

           
            
            <div class="col-md-1 col-lg-3 mb-4 align-items-center">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-secondary text-white">
                  <p>Jumat</p>
                </div>

                <div class="card-body text-center">
                  <b>09.00-11.00</b>
                  <p>Data Mining</p>
                  <p>Ruang H.2.3</p>
                </div>

                
                <div class="card-body text-center">
                  <b>13.00-15.00</b>
                  <p>Informasi</p>
                  <p>Ruang H.4.4</p>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-lg-3 mb-4 ">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-dark text-white">
                  <p>Sabtu</p>
                </div>

                <div class="card-body text-center">
                  <b>08.00-10.00</b>
                  <p>Bimbingan Karir</p>
                  <p>Online</p>
                </div>

                
                <div class="card-body text-center">
                  <b>10.30-12.00</b>
                  <p>PKN</p>
                  <p>Online</p>
                </div>
              </div>
            </div>
            <div class="col-md-1 col-lg-3 mb-4 align-items-center">
              <div class="card h-100 shadow-sm">
                <div class="card-header bg-success text-white">
                  <p>Minggu</p>
                </div>

                <div class="card-body text-center">
                  <p>Tidak Ada Jadwal</p>
                  <p>Ketua Lelah</p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="About" class="p-5 bg-danger-subtle">
        <div class="container py-5">
          <div class="row justify-content-center align-items-center gap-3">
            <div class="col-12 col-md-3" id="pGambar">
              <div class="w-100 ratio ratio-1x1">
                <img src="https://steamuserimages-a.akamaihd.net/ugc/2204010566893210113/95766DCED724BC539C879F63C41837C04809CE7C/?imw=637&imh=358&ima=fit&impolicy=Letterbox&imcolor=%23000000&letterbox=true" alt="" class="img-fluid object-fit-cover rounded-circle shadow shadown-md">
              </div>

            </div>
            <div class="col-12 col-md-6 text-center text-md-start" id="pInfo">
              <div class="h5 fw-normal">A11.2023.15458</div>
              <div class="h1 fw-bold">Felixs Togar Nugroho Siahaan</div>
              <div class="h6 fw-normal">Program Studi Teknik Informatika</div>
              <div class="h6 fw-bold">Universitas Dian Nuswantoro</div>
            </div>
          </div>
        </div>
      </section>


     
      <footer class="bg-dark text-white p-5 mt-4">
        <div class="container text-center">
          <a href="https://www.instagram.com/brennndra/profilecard/?igsh=MW9vdzVwb2YzbW01ZA==" target="_blank" class="text-white">
            <i class="bi bi-instagram" style="font-size: 2rem;"></i>
          </a><br>
          <b class="mt-3 mb-0">FelixSiahaan &copy; <?= date('Y') ?></b>
        </div>
      </footer>


<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>