<?php
include "../../config/conect.php";
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$tensanpham_nhap = $_POST['tensanpham'];
$gianhap = $_POST['gianhap'];
$soluong_nhap = $_POST['soluong'];

$noinhap = $_POST['ncc'];
$tinhtrang = $_POST['tinhtrang'];
$ngaynhap = $_POST['ngaynhap'];
$ten_nv = $_POST['nv'];

//thêm sản phẩm chi tiết
if (isset($_POST['addsp'])) {
    // Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_cartdetail_tam(tensanpham,gianhap, soluong) 
                 VALUES ('$tensanpham_nhap','$gianhap', '$soluong_nhap')";

    if (mysqli_query($mysqli, $sql_them)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
                window.location = '../../index.php?action=quanlynhap&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['taodonnhap'])) {
    // Thêm đơn nhập sản phẩm
    $sql_nhap = "INSERT INTO tbl_nhap(thoigian, id_ncc, trangthai, ten_nv) 
        VALUES ('$ngaynhap','$noinhap', '$tinhtrang', '$ten_nv')";
    $cart_query = mysqli_query($mysqli, $sql_nhap);
    $id_nhap = mysqli_insert_id($mysqli);

    if ($cart_query) {
        // Lấy dữ liệu từ bảng tạm
        $sql_lietke = "SELECT * FROM tbl_cartdetail_tam ORDER BY id_tam DESC";
        $query_lietke = mysqli_query($mysqli, $sql_lietke);

        while ($row = mysqli_fetch_array($query_lietke)) {
            $tensp = $row['tensanpham'];
            $gianhap = $row['gianhap'];
            $soluong = $row['soluong'];

            // Chèn vào bảng chi tiết nhập
            $insert_cardetail_nhap = "INSERT INTO tbl_cartdetail_nhap(tensanpham, gianhap, soluong, id_nhap) 
                                      VALUES ('$tensp', '$gianhap', '$soluong', '$id_nhap')";
            mysqli_query($mysqli, $insert_cardetail_nhap);

            // Thử chèn sản phẩm vào kho hoặc thêm mới sản phẩm
            $sql_them = "INSERT INTO tbl_sanpham(tensanpham, soluong, giasanpham, giamua, id_danhmuc, avt, id_ncc, tinhtrang, mota) 
    VALUES ('$tensp', '$soluong', '0', '$gianhap', '0', '0', '$noinhap', '1', '0')";

            mysqli_query($mysqli, $sql_them);
        }

        // / Xóa tất cả các sản phẩm trong bảng tạm sau khi chèn vào bảng chính
        $sql_xoa = "DELETE FROM tbl_cartdetail_tam";
        mysqli_query($mysqli, $sql_xoa);

        echo "<script>
        alert('Bạn đã tạo đơn thành công. MÃ ĐƠN là \"$id_nhap\" ');
                window.location = '../../index.php?action=quanlynhap&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['dathanhtoan'])) {
    $id_nhap = $_POST['idnhap'];
    $sql = "UPDATE tbl_nhap SET trangthai = 1 WHERE id_nhap = '$id_nhap' ";
    if (mysqli_query($mysqli, $sql)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
            window.location = '../../index.php?action=quanlynhap&query=chitiet&id=$id_nhap';
          </script>";
    } else {
        // Hiển thị thông báo lỗi nếu có lỗi trong quá trình cập nhật
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['chuathanhtoan'])) {
    $id_nhap = $_POST['idnhap'];
    $sql = "UPDATE tbl_nhap SET trangthai = 0 WHERE id_nhap = '$id_nhap' ";
    if (mysqli_query($mysqli, $sql)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
            window.location = '../../index.php?action=quanlynhap&query=chitiet&id=$id_nhap';
          </script>";
    } else {
        // Hiển thị thông báo lỗi nếu có lỗi trong quá trình cập nhật
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['xoaall'])) {
    // Xóa tât cả đơn nhập trong bảng tạm
    $sql_xoahet = "DELETE FROM tbl_cartdetail_tam";
    mysqli_query($mysqli, $sql_xoahet);

    echo "<script>
                window.location = '../../index.php?action=quanlynhap&query=them';
              </script>";
} elseif (isset($_GET['idtam'])) {
    // Xóa một sản phẩm trong bảng tạm
    $id = $_GET['idtam'];
    $sql = "SELECT * FROM tbl_cartdetail_tam WHERE id_tam = '$id' LIMIT 1";
    $query = mysqli_query($mysqli, $sql);

    $sql_xoa = "DELETE FROM tbl_cartdetail_tam WHERE id_tam = '$id'";
    mysqli_query($mysqli, $sql_xoa);

    echo "<script>
                window.location = '../../index.php?action=quanlynhap&query=them';
              </script>";
} elseif (isset($_GET['idnhap'])) {
    $id = $_GET['idnhap'];

    $sql_xoa = "DELETE FROM tbl_cartdetail_nhap WHERE id_nhap = '$id'";
    mysqli_query($mysqli, $sql_xoa);

    // In ra câu truy vấn để kiểm tra
    $sql_xoa_nhap = "DELETE FROM tbl_nhap WHERE id_nhap = '$id'";
    // Thực hiện truy vấn
    mysqli_query($mysqli, $sql_xoa_nhap);


    echo "<script>
        window.location = '../../index.php?action=quanlynhap&query=danhsach';
      </script>";
}
