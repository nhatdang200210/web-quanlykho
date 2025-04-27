<?php
include "../../config/conect.php";
$tenncc = $_POST['tenncc'];
$email = $_POST['email'];
$sdt = $_POST['sdt'];
$diachi = $_POST['diachi'];


if (isset($_POST['themncc'])) {
    // Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_ncc(tenncc, email_ncc, sdt_ncc, diachi_ncc) 
                 VALUES ('$tenncc', '$email', '$sdt', '$diachi')";

    if (mysqli_query($mysqli, $sql_them)) {

        // Hiển thị thông báo thành công và quay lại trang quản lý sản phẩm
        echo "<script>
                alert('Bạn đã thêm nhà cung cấp \"$tenncc\" thành công.');
                window.location = '../../index.php?action=quanlyncc&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['suancc'])) {
    //---------------------------------------sửa-------------------------------------
    $sql_sua = "UPDATE tbl_ncc
        SET tenncc = '$tenncc', email_ncc = '$email', sdt_ncc = '$sdt', diachi_ncc = '$diachi' WHERE id_ncc ='$_GET[idncc]' ";

    mysqli_query($mysqli, $sql_sua);

    // sau khi đã sửa thì quay về vị trí ban đầu
    echo "<script>
            alert('Bạn đã sửa nhà cung cấp thành công.');
            window.location = '../../index.php?action=quanlyncc&query=lietke';
        </script>";
} elseif (isset($_POST['huy'])) {
    echo "<script>
            window.location = '../../index.php?action=quanlyncc&query=lietke';
        </script>";
} else {
    $id = $_GET['idncc'];
    $sql_xoa = "DELETE FROM tbl_ncc WHERE id_ncc ='$id' ";
    mysqli_query($mysqli, $sql_xoa);
    // header('Location:../../index.php?action=quanlysanpham&query=them');
    echo "<script>
            window.location = '../../index.php?action=quanlyncc&query=lietke';
        </script>";
}
