<?php
include "../../config/conect.php";
$tenkhachhang = $_POST['tenkhachhang'];
$sdt = $_POST['sdt'];
$email = $_POST['email'];
$diachi = $_POST['diachi'];

if (isset($_POST['themkhachhang'])) {
    // Kiểm tra xem email hoặc số điện thoại đã tồn tại hay chưa
    $sql_kiemtra = "SELECT * FROM tbl_khachhang WHERE email = '$email' OR sdt = '$sdt'";
    $query_kiemtra = mysqli_query($mysqli, $sql_kiemtra);
    $rows = mysqli_num_rows($query_kiemtra);

    if ($rows > 0) {
        // Nếu tồn tại, hiển thị thông báo lỗi
        echo "<script>
            alert('Email hoặc Số điện thoại đã tồn tại! Vui lòng sử dụng email hoặc số điện thoại khác');
            window.location = '../../index.php?action=quanlytaikhoan&query=them';
          </script>";
    } else {
        // Nếu không tồn tại, tiến hành thêm khách hàng mới
        $sql_them = "INSERT INTO tbl_khachhang(tenkhachhang, sdt, email, diachi) 
                 VALUES ('$tenkhachhang', '$sdt', '$email', '$diachi')";

        if (mysqli_query($mysqli, $sql_them)) {
            // Hiển thị thông báo thành công và quay lại 
            echo "<script>
                alert('Thêm khách hàng thành công!');
                window.location = '../../index.php?action=quanlytaikhoan&query=them';
              </script>";
        } else {
            // Hiển thị thông báo lỗi nếu có lỗi trong quá trình thêm
            echo "Lỗi: " . mysqli_error($mysqli);
        }
    }
}
 elseif (isset($_POST['suakhachhang'])) {
    // ID của khách hàng đang được sửa
    $idkhachhang = $_GET['idkhachhang'];
    // Kiểm tra xem email hoặc số điện thoại đã tồn tại ở các khách hàng khác hay chưa
    $sql_kiemtra = "SELECT * FROM tbl_khachhang 
     WHERE (email = '$email' OR sdt = '$sdt') 
     AND id_khachhang != '$idkhachhang'";
    $query_kiemtra = mysqli_query($mysqli, $sql_kiemtra);
    $rows = mysqli_num_rows($query_kiemtra);

    if ($rows > 0) {
        // Nếu tồn tại, hiển thị thông báo lỗi
        echo "<script>
            alert('Email hoặc Số điện thoại đã tồn tại! Vui lòng sử dụng email hoặc số điện thoại khác');
            window.location = '../../index.php?action=quanlytaikhoan&query=lietke';
          </script>";
    } else {
        // Nếu không tồn tại, tiến hành cập nhật thông tin khách hàng
        $sql_sua = "UPDATE tbl_khachhang SET 
                 tenkhachhang = '$tenkhachhang', sdt = '$sdt', email = '$email', diachi = '$diachi' 
                 WHERE id_khachhang = '$idkhachhang'";

        if (mysqli_query($mysqli, $sql_sua)) {
            // Hiển thị thông báo thành công và quay lại 
            echo "<script>
                alert('Sửa thông tin khách hàng thành công!');
                window.location = '../../index.php?action=quanlytaikhoan&query=lietke';
              </script>";
        } else {
            // Hiển thị thông báo lỗi nếu có lỗi trong quá trình cập nhật
            echo "Lỗi: " . mysqli_error($mysqli);
        }
    }
} else {
    $id = $_GET['idkhachhang'];

    $sql_xoa = "DELETE FROM tbl_khachhang WHERE id_khachhang ='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);

    echo "<script>
            
            window.location = '../../index.php?action=quanlytaikhoan&query=lietke';
        </script>";
}
