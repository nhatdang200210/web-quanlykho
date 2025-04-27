<?php
include "../../config/conect.php";
$tennv = $_POST['tennv'];
$manv = $_POST['manv'];
$dc = $_POST['dc'];
$sdt = $_POST['sdt'];
$email = $_POST['email'];
$pass = md5($_POST['pass']);

if (isset($_POST['themnv'])) {
    // Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_admin(tennv, manv, diachi, sdt, username, password, admin_status) 
                 VALUES ('$tennv', '$manv', '$dc', '$sdt', '$email', '$pass', '1')";

    if (mysqli_query($mysqli, $sql_them)) {

        // Hiển thị thông báo thành công và quay lại trang quản lý sản phẩm
        echo "<script>
                alert('Bạn đã thêm nhân viên \"$tennv\" thành công.');
                window.location = '../../index.php?action=quanlynv&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['suanv'])) {
    //---------------------------------------sửa -------------------------------------
    $id_sanpham = $_GET['idnv'];

    $sql_sua = "UPDATE tbl_admin 
        SET tennv = '$tennv', manv = '$manv', diachi = '$dc', sdt = '$sdt', username = '$email', password='$pass' WHERE id_admin='$_GET[idnv]'";

    mysqli_query($mysqli, $sql_sua);

    // sau khi đã sửa thì quay về vị trí ban đầu
    echo "<script>
            alert('Bạn đã cập nhật thông tin nhân viên thành công.');
            window.location = '../../index.php?action=quanlynv&query=lietke';
        </script>";
} elseif (isset($_POST['huy'])) {
    echo "<script>
            window.location = '../../index.php?action=quanlynv&query=lietke';
        </script>";
} else {
    $id = $_GET['idnv'];
    $sql = "SELECT * FROM tbl_admin WHERE id_admin = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);

    $sql_xoa = "DELETE FROM tbl_admin WHERE id_admin = '$id' ";
    mysqli_query($mysqli, $sql_xoa);
    // header('Location:../../index.php?action=quanlysanpham&query=them');
    echo "<script>
            
            window.location = '../../index.php?action=quanlynv&query=lietke';
        </script>";
}
