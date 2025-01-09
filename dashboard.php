<?php
//query untuk mengambil data article
$sql1 = "SELECT * FROM article ORDER BY tanggal DESC";
$hasil1 = $conn->query($sql1);

$sql2 = "SELECT COUNT(id) AS jumlah FROM gallery";
$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data article
$jumlah_article = $hasil1->num_rows;
$jumlah_gallery = $hasil2->fetch_assoc()['jumlah'];

//query untuk mengambil data gallery
//$sql2 = "SELECT * FROM gallery ORDER BY tanggal DESC";
//$hasil2 = $conn->query($sql2);

//menghitung jumlah baris data gallery
//$jumlah_gallery = $hasil2->num_rows;
?>
<div class="row row-cols-1 row-cols-md-4 g-4 px-5 pt-4">
    <div class="col">
        <div class="card border border-danger mb-3 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start gap-2">
                    <h5 class="card-title">
                        <i class="bi bi-newspaper"></i> Article
                    </h5> 
                    <span class="badge rounded-pill text-bg-danger small">
                        <?php echo $jumlah_article; ?>
                    </span>
                </div>
            </div>
        </div>
    </div> 
    <div class="col">
        <div class="card border border-danger mb-3 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start gap-2">
                    <h5 class="card-title">
                        <i class="bi bi-camera"></i> Gallery
                    </h5> 
                    <span class="badge rounded-pill text-bg-danger small">
                        <?php echo $jumlah_gallery; ?>
                    </span>
                </div>
            </div>
        </div>
    </div> 
</div>