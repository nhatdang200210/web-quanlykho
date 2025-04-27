<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config/conect.php');

// Kiểm tra nếu người dùng đã đăng nhập
if (isset($_SESSION['dangnhap'])) {
    header("Location: index.php?action=quanlysanpham&query=lietkeall");
    exit();
}

if (isset($_POST['dangnhap'])) {
    $taikhoan = $_POST['username'];
    $matkhau = md5($_POST['password']);
    $sql = "SELECT * FROM tbl_admin WHERE username ='" . $taikhoan . "' AND password ='" . $matkhau . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $result = mysqli_fetch_array($row);
    $count = mysqli_num_rows($row);
    if ($count > 0) {
        $_SESSION['dangnhap'] = $taikhoan;
        $_SESSION['tt'] = $result['admin_status'];
        $_SESSION['id'] = $result['id_admin'];
        header("Location: index.php?action=quanlysanpham&query=lietkeall");
        exit();
    } else {
        echo
        "<script>
                alert('Tài khoản hoặc mật khẩu không đúng, vui lòng nhập lại.');
                window.location = 'login.php';
            </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập admin</title>
    <link rel="stylesheet" type="text/css" href="css/style-admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="wrapper_login">
        <div class="login">
            <form action="" method="POST">
                <div class="dangnhap">
                    <div style="width:70%">
                        <h1 style="font-weight: 800;">LOGIN</h1>
                        <h3 style="font-weight: 800;">Quản lý kho điện máy</h3>
                    </div>
                    <div style="width:30%">
                        <img src="../hinh/Artboard-2.webp" alt="" width="88%">
                    </div>

                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3" style="margin: 10% 0">
                    <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="bnt_dn">
                    <button type="submit" name="dangnhap" class="btn btn-primary" style="padding: 5px 30px; font-size:18px">Đăng nhập</button>
                </div>

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
<style type="text/css">
    body {
        background-image: url("https://png.pngtree.com/thumb_back/fh260/background/20230706/pngtree-flourishing-e-commerce-industry-3d-illustration-of-online-marketplaces-image_3822994.jpg");
        background-size: 100%;
        padding-top: 15%;

    }

    .wrapper_login {
        width: 30%;
        margin: auto;
        /* background-color: white; */
        background-color: rgba(251, 225, 183, 0.792);
        border-radius: 50px;
        border: 1px solid white;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        font-family: 'Times New Roman', Times, serif;
    }

    .wrapper_login div.bnt_dn {
        text-align: center;
        margin-top: 10%;

    }

    .wrapper_login div.bnt_dn button {
        transition: all 0.3s ease;
    }

    .wrapper_login div.bnt_dn button:hover {
        background-color: green;
        transform: scale(1.1);
    }

    .dangnhap {
        color: red;
        font-weight: bold;
        text-align: center;
        /* margin-bottom: 9%; */
        display: flex;
        align-items: center;
        /* Căn giữa các phần tử theo chiều dọc */
        justify-content: center;
        /* Căn giữa các phần tử theo chiều ngang */
        gap: 10px;
        /* Khoảng cách giữa chữ và ảnh */
        /* border: 1px solid; */
        margin-bottom: 20px;
        /* padding: 20px; */
    }

    .dangnhap img {
        border-radius: 35px;
    }

    .login {
        /* border: 1px solid; */
        width: 60%;
        margin: auto;
        margin-top: 10%;
        margin-bottom: 10%;
    }

    .login input {
        font-size: 22px;
    }

    .login label {
        font-size: 24px;
        font-weight: bold;
    }
</style>

</html>