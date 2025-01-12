<?php

require "koneksi.php";
require "upload_foto.php";
function CheckUser()
{
    global $conn;
    if(!isset($_SESSION['username'])) return false;
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username='$username'";
    $hasil = $conn->query($sql);
    if($hasil->num_rows == 0) return false;
    
    return $hasil->fetch_assoc();
}
function CheckProfileChange($user)
{
    global $conn;
    if(!isset($_POST['simpan'])) return false;
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username='$username'";
    $hasil = $conn->query($sql);
    if($hasil->num_rows == 0) return false;
    $gambar='';
    $sql = "UPDATE user SET password=?, foto=? WHERE username=?";
    if(isset($_FILES['gambar']))
    {
        $nama_gambar = $_FILES['gambar']['name'];
        if ($nama_gambar != '');
        {
            $cek_upload = upload_foto($_FILES["gambar"]);
            if ($cek_upload['status']) 
            {
                $gambar = $cek_upload['message'];
            } 
        }
    }
    $password = $_POST["password"] != '' ? md5($_POST["password"]) : $user["password"];
    $gambar = $gambar!='' ? $gambar : $user["foto"];
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $password, $gambar, $username);
    $stmt->execute();
}
$user = CheckUser();
if(!$user)
{
    return;
}
else
{
    CheckProfileChange($user);
    $user = CheckUser();
}


?>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card small p-4">
                <div class="card-body">
                    <div class="d-flex flex-column align-items-center mb-4">
                        <div class="ratio ratio-1x1" style="width: 80px;">
                            <img src="foto/<?= $user['foto'] ?>" alt="" class="img-fluid rounded-circle object-fit-cover" id="preview">
                        </div>
                        
                        <span class="fw-bold fs-5">
                            <?= $user['username'] ?>
                        </span>
                    </div>

                    <!-- Menampilkan Pesan Error -->
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Login -->
                    <form method="POST" action="" class="small" enctype="multipart/form-data">
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control mb-1" >
                            <div class="small text-secondary">Input jika ingin mengganti password</div>
                        </div>
                        <div class="mb-4">
                            <label for="gambar" class="form-label">Profile Image</label>
                            <input type="file" id="gambar" name="gambar" class="form-control small">
                        </div>
                        <div class="w-100">
                            <button type="submit" class="btn btn-primary w-100" name="simpan">Ubah Profile</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
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