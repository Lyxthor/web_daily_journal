<?php
session_start();

include "koneksi.php";  

//check jika belum ada user yang login arahkan ke halaman login
if (!isset($_SESSION['username'])) { 
	header("location:login.php"); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>My Daily Journal | Admin</title>
    <link rel="icon" href="foto\gambar login.png" />
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
    />
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous"
    /> 
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>  
        html {
            position: relative;
            min-height: 100%;
        }
        body {
            margin-bottom: 100px; /* Margin bottom by footer height */
        }
    </style>
</head>
<body class="font-poppins">
<nav class="navbar navbar-expand-lg bg-light sticky-top px-2 py-4">
    <div class="container">
            <a class="navbar-brand" target="_blank" href=".">My Daily Journal</a>
            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                <li class="nav-item">
                    <a class="nav-link fs-6" href="admin.php?page=dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6" href="admin.php?page=article">Article</a>
                </li> 
                <li class="nav-item">
                    <a class="nav-link fs-6" href="admin.php?page=gallery">Gallery</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-danger fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['username']?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="?page=profile">Profile</a></li> 
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li> 
                    </ul>
                </li> 
            </ul>
            </div>
        </div>
    </nav>
    
    <!-- content begin -->
    <section id="content" class="p-5">
        <div class="container shadow-sm py-5 rounded">
            <?php
            if(isset($_GET['page']))
            {
            ?>
                <div class="px-5 mb-2 border-bottom border-danger-subtle">
                <h4 class="lead display-6 "><?= ucfirst($_GET['page'])?></h4>
                </div>
                <?php
                include($_GET['page'].".php");
            }
            else
            {
            ?>
                <div class="px-5 mb-2 border-bottom border-danger-subtle">
                <h4 class="lead display-6 ">Dashboard</h4>
                </div>
                <?php
                include("dashboard.php");
            }
            ?>
        </div>
    </section>
    <!-- content end -->
    <div class="w-full py-5">

    </div>
    <!-- footer begin -->
    <footer class="position-absolute bottom-0 py-5 w-100 text-center bg-dark text-white-50">
        <div class="d-flex justify-content-center">
            <a href="https://www.instagram.com/udinusofficial"
            ><i class="bi bi-instagram h2 p-2 text-light"></i
            ></a>
            <a href="https://twitter.com/udinusofficial"
            ><i class="bi bi-twitter h2 p-2 text-light"></i
            ></a>
            <a href="https://wa.me/+6282138504746"
            ><i class="bi bi-whatsapp h2 p-2 text-light"></i
            ></a>
        </div>
        <div>Felix Siahaan &copy; 2025</div>
    </footer>
    <!-- footer end -->
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"
    ></script>
</body>
</html> 