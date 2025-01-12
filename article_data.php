<table class="table table-responsive table-hover small">
                <thead class="table-secondary text-black-50">
                    <tr>
                        <th class="py-3 text-center">No</th>
                        <th class="w-25 py-3">Thumbnail</th>
                        <th class="w-50 py-3">Konten</th>
                        <th class="w-25 py-3">Info</th>
                        <th class="w-25 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php';

                    $hlm = (isset($_GET['hlm'])) ? (int) $_GET['hlm'] : 1;
                
                    $limit = 3;
                    $limit_start = ($hlm - 1) * $limit;
                    $no = $limit_start + 1;

                    $sql = "SELECT * FROM article ORDER BY tanggal DESC LIMIT $limit_start, $limit";
                    $hasil = $conn->query($sql);

                    // $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                    // $hasil = $conn->query($sql);

                    $no = 1;
                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td class="py-3 text-center">
                                <?= $no++ ?>
                            </td>
                            <td class="py-3">
                                <div>
                                    
                                    <div class="d-flex w-100 flex-wrap gap-2">
                                        <?php if ($row["gambar"] != '' && file_exists('foto/' . $row["gambar"] . '')) {?>
                                                <div class="w-100 ratio ratio-16x9">
                                                    <img src="foto/<?= $row["gambar"] ?>" class="img-fluid rounded object-cover">
                                                </div>
                                        <?php   }?>
                                        
                                    </div>
                                </div>
                            </td>
                            <td class="py-3">
                                <div class="fw-bold mb-2">
                                    <?= $row["judul"] ?>
                                </div>
                                <div class="small text-secondary">
                                    <?= substr_replace($row["isi"], "...", 200)?> <a href="post.php?post_id=<?= $row['id'] ?>">Show Article</a>
                                </div>
                                
                            </td>
                            <td class="py-3">
                                <div class="small">
                                    Diposting pada <?= date("j F Y", strtotime($row['tanggal'])) ?>, <br>
                                    pukul <?= date("H:i", strtotime($row['tanggal'])) ?> <br>
                                    oleh <?= $row['username'] ?>
                                </div>
                            </td>
                            <td class="py-3">
                                <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $row["id"] ?>">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row["id"] ?>">
                                    <i class="bi bi-x-circle"></i>
                                </a>

    <!-- Awal Modal Edit -->
<div class="modal fade" id="modalEdit<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Judul</label>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="text" class="form-control" name="judul" placeholder="Tuliskan Judul Artikel" value="<?= $row["judul"] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="floatingTextarea2">Isi</label>
                        <textarea class="form-control" placeholder="Tuliskan Isi Artikel" name="isi" required><?= $row["isi"] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput2" class="form-label">Ganti Gambar</label>
                        <input type="file" class="form-control" name="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="formGroupExampleInput3" class="form-label">Gambar Lama</label>
                        <?php
                        if ($row["gambar"] != '') {
                            if (file_exists('foto/' . $row["gambar"] . '')) {
                        ?>
                                <br><img src="foto/<?= $row["gambar"] ?>" width="100">
                        <?php
                            }
                        }
                        ?>
                        <input type="hidden" name="gambar_lama" value="<?= $row["gambar"] ?>">
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
<!-- Akhir Modal Edit -->

<!-- Awal Modal Hapus -->
<div class="modal fade" id="modalHapus<?= $row["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Article</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" action="" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus artikel "<strong><?= $row["judul"] ?></strong>"?</label>
                        <input type="hidden" name="id" value="<?= $row["id"] ?>">
                        <input type="hidden" name="gambar" value="<?= $row["gambar"] ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">batal</button>
                    <input type="submit" value="hapus" name="hapus" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Hapus -->
</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>


<div class="d-flex justify-content-between align-items-center">
<?php 
$sql1 = "SELECT * FROM article";
$hasil1 = $conn->query($sql1); 
$total_records = $hasil1->num_rows;
?>
<p>Total article : <?php echo $total_records; ?></p>
<nav class="mb-2">
    <ul class="pagination justify-content-end">
        <?php
            

            $jumlah_page = (int) ceil($total_records / $limit);
            $jumlah_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
            $start_number = ($hlm > $jumlah_number)? $hlm - $jumlah_number : 1;
            $end_number = ($hlm < ($jumlah_page - $jumlah_number))? $hlm + $jumlah_number : $jumlah_page;
            $params = $_GET;
            
            $link_prev = ($hlm > 1)? $hlm - 1 : 1;
            $param1 = array_merge($params, ["hlm"=>1]);
            $param2 = array_merge($params, ["hlm"=>$link_prev]);

            $link1 = http_build_query($param1);
            $link2 = http_build_query($param2);
            $active = $hlm == 1 ? "disabled" : "";
            echo '<li class="page-item '.$active.'"><a class="page-link" href="?'.$link1.'">First</a></li>';
            echo '<li class="page-item '.$active.'"><a class="page-link" href="?'.$link2.'"><span aria-hidden="true">&laquo;</span></a></li>';
            

            for($i = $start_number; $i <= $end_number; $i++){
                $param = array_merge($params, ["hlm"=>$i]);
                $queryString = http_build_query($param);
                $link_active = ($hlm == $i)? ' active' : '';
                echo '<li class="page-item halaman '.$link_active.'" id="'.$i.'"><a class="page-link" href="?'.$queryString.'">'.$i.'</a></li>';
            }

            $link_next = ($hlm < $jumlah_page)? $hlm + 1 : $jumlah_page;
            $param1 = array_merge($params, ["hlm"=>$jumlah_page]);
            $param2 = array_merge($params, ["hlm"=>$link_next]);

            $link1 = http_build_query($param1);
            $link2 = http_build_query($param2);
            $active = $hlm == $jumlah_page ? "disabled" : "";
            echo '<li class="page-item halaman '.$active.'" id="'.$link_next.'"><a class="page-link" href="?'.$link2.'"><span aria-hidden="true">&raquo;</span></a></li>';
            echo '<li class="page-item halaman '.$active.'" id="'.$jumlah_page.'"><a class="page-link" href="?'.$link1.'">Last</a></li>';
        ?>
    </ul>
</nav>
</div>