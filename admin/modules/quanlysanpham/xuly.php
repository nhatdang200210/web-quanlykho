<?php
include "../../config/conect.php";
$tensanpham = $_POST['tensanpham'];
$soluong = $_POST['soluong'];
$giasanpham = $_POST['giasanpham'];
$giamua = $_POST['giamua'];
$danhmuc = $_POST['danhmuc'];
$mota = $_POST['mota'];

// Xử lý hình ảnh
$hinhanh = $_FILES['hinhanh']['name'];
$hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
$hinhanh = time() . '_' . $hinhanh;

$noinhap = $_POST['ncc'];
// $tinhtrang = $_POST['tinhtrang'];


if (isset($_POST['themsanpham'])) {
    // Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_sanpham(tensanpham, soluong, giasanpham, giamua, id_danhmuc, avt, id_ncc, tinhtrang, mota) 
                 VALUES ('$tensanpham', '$soluong', '$giasanpham', '$giamua', '$danhmuc', '$hinhanh', '$noinhap', '1', '$mota')";

    if (mysqli_query($mysqli, $sql_them)) {
        // Di chuyển file hình ảnh đã tải lên vào thư mục uploads
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

        // Hiển thị thông báo thành công và quay lại trang quản lý sản phẩm
        echo "<script>
                alert('Bạn đã thêm sản phẩm \"$tensanpham\" thành công.');
                window.location = '../../index.php?action=quanlysanpham&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['suasanpham'])) {
    //---------------------------------------sửa sản phẩm-------------------------------------
    $id_sanpham = $_GET['idsanpham'];
    // echo 'abc';
    // Xử lý hình ảnh đại diện
    if (!empty($_FILES['hinhanh']['name'])) {
        //di chuyển hình ảnh vào folder
        move_uploaded_file($hinhanh_tmp, 'uploads/' . $hinhanh);

        $sql_sua = "UPDATE tbl_sanpham 
        SET tensanpham = '$tensanpham', soluong = '$soluong', giasanpham = '$giasanpham', giamua = '$giamua', id_danhmuc = '$danhmuc', avt = '$hinhanh', id_ncc='$noinhap', mota = '$mota' WHERE id_sanpham='$_GET[idsanpham]'";

        //xoá hình ảnh bị thay thế (sửa) khỏi folder
        $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$_GET[idsanpham]' LIMIT 1";
        $query = mysqli_query($mysqli, $sql);
        while ($row = mysqli_fetch_array($query)) {
            unlink('uploads/' . $row['avt']);
        }
    } else {
        $sql_sua = "UPDATE tbl_sanpham 
        SET tensanpham = '$tensanpham', soluong = '$soluong', giasanpham = '$giasanpham', giamua = '$giamua', id_danhmuc = '$danhmuc', id_ncc='$noinhap',  mota = '$mota' WHERE id_sanpham='$_GET[idsanpham]'";
    }
    mysqli_query($mysqli, $sql_sua);

    // sau khi đã sửa thì quay về vị trí ban đầu
    echo "<script>
            alert('Bạn đã sửa sản phẩm thành công.');
            window.location = '../../index.php?action=quanlysanpham&query=lietkeall';
        </script>";
} else {
    $id = $_GET['idsanpham'];
    $sql = "SELECT * FROM tbl_sanpham WHERE id_sanpham = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);
    while ($row = mysqli_fetch_array($query)) {
        unlink('uploads/' . $row['hinhanh']);
    }
    $sql_xoa = "DELETE FROM tbl_sanpham WHERE id_sanpham ='" . $id . "'";
    mysqli_query($mysqli, $sql_xoa);
    // header('Location:../../index.php?action=quanlysanpham&query=them');
    echo "<script>
            
            window.location = '../../index.php?action=quanlysanpham&query=lietkeall';
        </script>";
}
