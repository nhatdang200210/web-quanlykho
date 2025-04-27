<?php
include "../../config/conect.php";
$id_sanpham = $_POST['id_sanpham'];
$soluong_xuat = $_POST['soluong'];
$id_khachhang = $_POST['id_khachhang'];
$tinhtrang = $_POST['tinhtrang'];
$ngayxuat = $_POST['ngayxuat'];
$ten_nv = $_POST['ten_nv'];
//thêm sản phẩm chi tiết
if (isset($_POST['addxuat'])) {
    // Lấy số lượng tồn kho của sản phẩm
    $sql_check = "SELECT soluong, tensanpham FROM tbl_sanpham WHERE id_sanpham = '$id_sanpham'";
    $result = mysqli_query($mysqli, $sql_check);
    $row = mysqli_fetch_array($result);
    $soluongton = $row['soluong'];
    $tensp = $row['tensanpham'];

    // Kiểm tra nếu số lượng nhập vào lớn hơn số lượng tồn kho
    if ($soluong_xuat > $soluongton) {
        echo "<script>
                alert('Số lượng sản phẩm \"$tensp\" chỉ còn lại: \"$soluongton\" sản phẩm!');
                window.location = '../../index.php?action=quanlyxuat&query=them';
              </script>";
        exit();
    }

    // Thêm sản phẩm
    $sql_them = "INSERT INTO tbl_xuat_tam(id_sanpham, soluong) 
                 VALUES ('$id_sanpham', '$soluong_xuat')";

    if (mysqli_query($mysqli, $sql_them)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
                window.location = '../../index.php?action=quanlyxuat&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['taodonxuat'])) {
    // Thêm đơn xuất sản phẩm
    $sql_xuat = "INSERT INTO tbl_xuat(id_khachhang, trangthai, ngayxuat, ten_nv) 
        VALUES ('$id_khachhang', '$tinhtrang','$ngayxuat', '$ten_nv')";
    $cart_query = mysqli_query($mysqli, $sql_xuat);
    $id_xuat = mysqli_insert_id($mysqli);

    if ($cart_query) {
        // Lấy dữ liệu từ bảng tạm
        $sql_tam = "SELECT *, tbl_xuat_tam.soluong AS soluong_tam FROM tbl_xuat_tam, tbl_sanpham WHERE tbl_xuat_tam.id_sanpham = tbl_sanpham.id_sanpham";
        $query_tam = mysqli_query($mysqli, $sql_tam);

        while ($row = mysqli_fetch_array($query_tam)) {
            // $tensp = $row['tensanpham'];
            // $giaxuat = $row['giasanpham'];
            $soluong = $row['soluong_tam'];
            $id_sanpham = $row['id_sanpham'];


            // Chèn vào bảng chi tiết xuất
            $insert_cardetail_xuat = "INSERT INTO tbl_cartdetail_xuat(id_sanpham, soluong_xuat, id_xuat) 
                                      VALUES ('$id_sanpham', '$soluong', '$id_xuat')";
            mysqli_query($mysqli, $insert_cardetail_xuat);

            $update_soluong = "UPDATE tbl_sanpham 
                    SET soluong = soluong - $soluong
                    WHERE id_sanpham = '$id_sanpham'";
            mysqli_query($mysqli, $update_soluong);

            $update_tinhtrang = "UPDATE tbl_sanpham 
                    SET tinhtrang = 0
                    WHERE soluong = 0";
            mysqli_query($mysqli, $update_tinhtrang);
        }

        // / Xóa tất cả các sản phẩm trong bảng tạm sau khi chèn vào bảng chính
        $sql_xoa = "DELETE FROM tbl_xuat_tam";
        mysqli_query($mysqli, $sql_xoa);

        echo "<script>
        alert('Bạn đã tạo đơn thành công. MÃ ĐƠN là \"$id_xuat\" ');
                window.location = '../../index.php?action=quanlyxuat&query=them';
              </script>";
    } else {
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['dathanhtoan'])) {
    $id_xuat = $_POST['idxuat'];
    $sql = "UPDATE tbl_xuat SET trangthai = 1 WHERE id_xuat = '$id_xuat' ";
    if (mysqli_query($mysqli, $sql)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
            window.location = '../../index.php?action=quanlyxuat&query=chitiet&id=$id_xuat';
          </script>";
    } else {
        // Hiển thị thông báo lỗi nếu có lỗi trong quá trình cập nhật
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['chuathanhtoan'])) {
    $id_xuat = $_POST['idxuat'];
    $sql = "UPDATE tbl_xuat SET trangthai = 0 WHERE id_xuat = '$id_xuat' ";
    if (mysqli_query($mysqli, $sql)) {
        // Hiển thị thông báo thành công và quay lại 
        echo "<script>
            window.location = '../../index.php?action=quanlyxuat&query=chitiet&id=$id_xuat';
          </script>";
    } else {
        // Hiển thị thông báo lỗi nếu có lỗi trong quá trình cập nhật
        echo "Lỗi: " . mysqli_error($mysqli);
    }
} elseif (isset($_POST['xoaall'])) {
    // Xóa tât cả đơn nhập trong bảng tạm
    $sql_xoahet = "DELETE FROM tbl_xuat_tam";
    mysqli_query($mysqli, $sql_xoahet);

    echo "<script>
                window.location = '../../index.php?action=quanlyxuat&query=them';
              </script>";
} else {
    if (isset($_GET['idtam'])) {
        // Xóa một sản phẩm trong bảng tạm
        $id = $_GET['idtam'];
        $sql_xoa = "DELETE FROM tbl_xuat_tam WHERE id_xuat_tam = '$id'";
        mysqli_query($mysqli, $sql_xoa);

        echo "<script>
                window.location = '../../index.php?action=quanlyxuat&query=them';
              </script>";
    } elseif (isset($_GET['idxuat'])) {
        // Xóa đơn nhập trong bảng chính
        $id = $_GET['idxuat'];

        $sql_xoa = "DELETE FROM tbl_cartdetail_xuat WHERE id_xuat = '$id'";
        mysqli_query($mysqli, $sql_xoa);

        $sql_xoa_xuat = "DELETE FROM tbl_xuat WHERE id_xuat = '$id'";
        mysqli_query($mysqli, $sql_xoa_xuat);

        echo "<script>
                window.location = '../../index.php?action=quanlyxuat&query=danhsach';
              </script>";
    }
}
