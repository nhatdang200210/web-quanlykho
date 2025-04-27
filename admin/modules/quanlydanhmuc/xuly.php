<?php
include("../../config/conect.php");

$tenloai = $_POST['tendanhmuc'];

if (isset($_POST['themdanhmuc'])) {
    //thêm
    $sql_them = "INSERT INTO tbl_danhmuc (tendanhmuc) VALUES ('$tenloai')";
    mysqli_query($mysqli, $sql_them);
    // sau khi đã thêm thì quay về vị trí ban đầu
    echo "<script>
            alert('Bạn đã thêm danh mục \"$tenloai\" thành công.');
            window.location = '../../index.php?action=quanlydanhmuc&query=them';
        </script>";
} elseif (isset($_POST['suadanhmuc'])) {
    //sửa
    $sql_sua = "UPDATE tbl_danhmuc SET tendanhmuc='$tenloai' WHERE id_danhmuc='$_GET[iddanhmucsp]'";
    mysqli_query($mysqli, $sql_sua);
    // sau khi đã thêm thì quay về vị trí ban đầu
    echo "<script>
        alert('Bạn đã sửa danh mục thành công.');
        window.location = '../../index.php?action=quanlydanhmuc&query=lietke';
    </script>";
} elseif (isset($_POST['huy'])) {
    echo "<script>
            window.location = '../../index.php?action=quanlydanhmuc&query=lietke';
        </script>";
} else {
    // $id = $_GET['iddanhmucsp'];
    $sql_xoa = "DELETE FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[iddanhmucsp]'";
    mysqli_query($mysqli, $sql_xoa);
    echo "<script>
            window.location = '../../index.php?action=quanlydanhmuc&query=lietke';
        </script>";
    // header('Location:../../index.php?action=quanlydanhmucsanpham&query=them');
}
