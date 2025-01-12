<?php
require "koneksi.php";
require 'upload_foto.php';

function check()
{
    global $conn;
    if(isset($_POST['tambah']))
    {
        if(!isset($_FILES['gambar'])) return;
        if(!isset($_FILES['gambar']['name'])) return;
        $username = $_SESSION['username'];
        $tanggal = date('Y-m-d H:i:s');
        $nama_gambar = $_FILES['gambar']['name'];
        if ($nama_gambar == '') return;
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) 
        {
            $gambar = $cek_upload['message'];
            $sql = "INSERT INTO gallery (gambar, username, tanggal) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $gambar, $username, $tanggal);
            $stmt->execute();
        } 
        else 
        {
            echo 
            "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }
}
function CheckForUpdateRequest()
{
    global $conn;
    if(isset($_POST['edit']))
    {
        if(!isset($_FILES['gambar'])) return;
        if(!isset($_FILES['gambar']['name'])) return;
        $id = $_POST["id"];
        $gambar_lama = $_POST["gambar_lama"];
        $nama_gambar = $_FILES['gambar']['name'];
        if ($nama_gambar == '') return;
        $cek_upload = upload_foto($_FILES["gambar"]);
        if ($cek_upload['status']) 
        {
            unlink("foto/$gambar_lama");
            $gambar = $cek_upload['message'];
            $sql = "UPDATE gallery SET gambar=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $gambar, $id);
            $stmt->execute();
        } 
        else 
        {
            echo 
            "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=gallery';
            </script>";
            die;
        }
    }
}
function CheckForDeleteRequest()
{
    global $conn;
    if(isset($_POST['hapus'])) 
    {
        $id = $_POST["id"];
        $gambar = $_POST['gambar'];
        
        // Search for gallery
        if ($gambar != '') 
        {
            unlink("foto/" . $gambar);
        }
    
        $stmt = $conn->prepare("DELETE FROM gallery WHERE id =?");
    
        $stmt->bind_param("i", $id);
        $hapus = $stmt->execute();
    
        if ($hapus) 
        {
            echo 
            "<script>
                alert('Hapus data sukses');
                document.location='admin.php?page=gallery';
            </script>";
        } 
        else 
        {
            echo 
            "<script>
                alert('Hapus data gagal');
                document.location='admin.php?page=gallery';
            </script>";
        }
    
        $stmt->close();
        $conn->close();
    }
}

check();
CheckForDeleteRequest();
CheckForUpdateRequest();


?>
<div class="container-fluid">
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary btn-sm font-montserrat mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i>
            <span>Upload Gambar</span> 
        </button>
    </div>
    <table class="table table-responsive table-hover small">
        <thead class="table-secondary text-black-50">
            <tr>
                <th class="py-3 text-center">No</th>
                <th class="w-25 py-3">Gambar</th>
                <th class="w-25 py-3">Info</th>
                <th class="w-25"></th>
                <th class="w-25 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $hlm = (isset($_GET['hlm'])) ? (int) $_GET['hlm'] : 1;
                
        $limit = 3;
        $limit_start = ($hlm - 1) * $limit;
        $no = $limit_start + 1;
        $total_records;

        $sql = "SELECT * FROM gallery LIMIT $limit_start, $limit";
        $hasil = $conn->query($sql);
        $sql = "SELECT COUNT(id) AS jumlah FROM gallery";
        $hasil1 = $conn->query($sql);
        $total_records = $hasil1->fetch_assoc()['jumlah'];
        $index = 0;
        ?>
            <?php if($hasil->num_rows == 0) : ?>
                <tr class="text-center">
                    <td colspan="4" class="text-muted bg-secondary">
                        Belum ada gambar di gallery
                    </td>
                </tr>
            <?php else : ?>
                <?php while($gallery = $hasil->fetch_assoc()) : ?>
                    <tr>
                        <td class="text-center">
                            <?= ++$index ?>
                        </td>
                        <td>
                            <div class="w-full ratio ratio-16x9">
                                <img src="foto/<?= $gallery['gambar'] ?>" alt="" class="img-fluid object-fit-cover rounded">
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                Diposting pada <?= date("j F Y", strtotime($gallery['tanggal'])) ?>, <br>
                                pukul <?= date("H:i", strtotime($gallery['tanggal'])) ?> <br>
                                oleh <?= $gallery['username'] ?>
                            </div>
                        </td>
                        <td>
                            <a href="#" title="show" class="" data-bs-toggle="modal" data-bs-target="#modalShow<?= $gallery["id"] ?>">
                                Detail Data
                            </a>
                        </td>
                        <td>
                            <a href="#" title="edit" class="badge rounded-pill text-bg-success" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $gallery["id"] ?>">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" title="delete" class="badge rounded-pill text-bg-danger" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $gallery["id"] ?>">
                                <i class="bi bi-x-circle"></i>
                            </a>
                        </td>
                        <!-- Awal Modal Liat-->
                        <div class="modal fade" id="modalShow<?= $gallery['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
                                    </div>
                                    
                                        <div class="modal-body">
                                            <div class="w-100">
                                                <img src="foto/<?= $gallery['gambar'] ?>" alt="" class="w-100">
                                            </div>
                                        
                                        </div>
                                        
                                    
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Liat-->
                        <!-- Awal Modal Edit-->
                        <div class="modal fade" id="modalEdit<?= $gallery['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Gambar</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="ResetPreview(event, `<?= $gallery['gambar'] ?>`, <?= $gallery['id'] ?>)"></button>
                                    </div>
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <input type="hidden" name="gambar_lama" value="<?= $gallery['gambar'] ?>">
                                            <input type="hidden" name="id" value="<?= $gallery['id'] ?>">
                                            <div class="w-100 ratio ratio-16x9">
                                                <img src="foto/<?= $gallery['gambar'] ?>" alt="" id="preview<?= $gallery['id'] ?>" class="img-fluid object-fit-cover">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formGroupExampleInput2" class="form-label">Gambar</label>
                                                <input type="file" class="form-control" name="gambar" id="gambar<?= $gallery["id"] ?>" onchange="ChangePreview(event, <?= $gallery['id'] ?>)">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="ResetPreview(event, `<?= $gallery['gambar'] ?>`, <?= $gallery['id'] ?>)">Close</button>
                                            <input type="submit" value="edit" name="edit" class="btn btn-primary">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Akhir Modal Edit-->
                        <!-- Awal Modal Hapus -->
                        <div class="modal fade" id="modalHapus<?= $gallery["id"] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Konfirmasi Hapus Gallery</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="post" action="">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="formGroupExampleInput" class="form-label">Yakin akan menghapus artikel "<strong><?= $gallery["judul"] ?></strong>"?</label>
                                                <input type="hidden" name="id" value="<?= $gallery['id'] ?>">
                                                <input type="hidden" name="gambar" value="<?= $gallery["gambar"] ?>">
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
                    </tr>
                <?php endwhile ?>
            <?php endif ?>
        </tbody>
    </table>
        
    </div>
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
                    <input type="submit" value="tambah" name="tambah" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Akhir Modal Tambah-->

<script>
    function ChangePreview(event, previewId)
    {
        const file = event.target.files[0];
        if (file) 
        {
            const reader = new FileReader();
            reader.onload = function(e) {
                $(`#preview${previewId}`).attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else 
        {
            $(`#preview${previewId}`).hide();
        }
    }
    function ResetPreview(event, gambar, previewId)
    {
        $(`#preview${previewId}`).attr('src', `foto/${gambar}`).show();
    }
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