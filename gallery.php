<?php
require "koneksi.php";
require 'upload_foto.php';

function check()
{
    global $conn;
    if(!isset($_FILES['gambar'])) return;
    if(!isset($_FILES['gambar']['name'])) return;
    $nama_gambar = $_FILES['gambar']['name'];
    if ($nama_gambar == '') return;
    $cek_upload = upload_foto($_FILES["gambar"]);
    if ($cek_upload['status']) 
    {
        $gambar = $cek_upload['message'];
        $sql = "INSERT INTO gallery (gambar) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $gambar);
        $stmt->execute();
    } 
    else 
    {
        echo 
        "<script>
            alert('" . $cek_upload['message'] . "');
            document.location='admin.php?page=article';
        </script>";
        die;
    }
}

check();


?>
<div class="container-fluid">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary btn-sm font-montserrat mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i>
            <span>Upload Gambar</span> 
        </button>
    </div>
    <div class="row row-cols-2">
        <?php 
        $hlm = (isset($_GET['hlm'])) ? (int) $_GET['hlm'] : 1;
                
        $limit = 4;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;
        $total_records;

        $sql = "SELECT * FROM gallery LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);
        $sql = "SELECT COUNT(id) AS jumlah FROM gallery";
        $hasil1 = $conn->query($sql);
        $total_records = $hasil1->fetch_assoc()['jumlah'];
        ?>
        <?php if($hasil->num_rows == 0) : ?>
            <div class="text-center">
                Belum ada foto di gallery
            </div>
        <?php else : ?>
            <?php while($gallery = $hasil->fetch_assoc()) : ?>
                <div class="col position-relative mb-4">
                    <div class="w-full ratio ratio-16x9">
                        <img src="foto/<?= $gallery['gambar'] ?>" alt="" class="img-fluid object-fit-cover rounded">
                    </div>
                    <button class="btn badge text-bg-danger position-absolute top-0">
                        x
                    </button>
                </div>
            <?php endwhile ?>
        <?php endif ?>
    </div>
    <ul class="pagination justify-content-end">
        <?php
            

            $jumlah_page = ceil($total_records / $limit);
            $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
            $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
            $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;
            $params = $_GET;
            
            if($hlm == 1){
                echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            } else {
                $link_prev = ($hlm > 1)? $hlm - 1 : 1;
                echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
                echo '<li class="page-item halaman" id="'.$link_prev.'"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
            }

            for($i = $start_number; $i <= $end_number; $i++){
                $params = array_merge($params, ["hlm"=>$i]);
                $queryString = http_build_query($params);
                $link_active = ($hlm == $i)? ' active' : '';
                echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="?'.$queryString.'">'.$i.'</a></li>';
            }

            if($hlm == $jumlah_page){
                echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
            } else {
            $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
                echo '<li class="page-item halaman" id="'.$link_next.'"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
                echo '<li class="page-item halaman" id="'.$jumlah_page.'"><a class="page-link" href="#">Last</a></li>';
            }
        ?>
    </ul>
</div>

<!-- Awal Modal Tambah-->
<div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Gambar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="w-100 ratio ratio-16x9">
                        <img alt="" id="preview" class="img-fluid object-fit-cover">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah-->
<script>
    $(document).ready(function() 
    {
        $('#gambar').on('change', function(event) 
        {
            const file = event.target.files[0];
            if (file) 
            {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(file);
            } else 
            {
                $('#preview').hide();
            }
        });
    });
</script>