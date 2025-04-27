<head>
    <title>Admin</title>
</head>
<?php
// Đếm tổng số đơn xuất hàng
$sql_sanpham = "SELECT COUNT(id_xuat) AS dem FROM tbl_xuat";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem = $rows['dem'];

// Xử lý lọc theo ngày và trạng thái thanh toán
$sql_lietke = "SELECT * FROM tbl_xuat, tbl_khachhang
               WHERE tbl_xuat.id_khachhang = tbl_khachhang.id_khachhang";

// Lọc theo ngày nếu có giá trị ngày
if (isset($_POST['filter_date'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    if (!empty($from_date) && !empty($to_date)) {
        $sql_lietke .= " AND tbl_xuat.ngayxuat BETWEEN '$from_date' AND '$to_date'";
    }
}

// Lọc theo trạng thái thanh toán nếu có chọn trạng thái
if (isset($_POST['filter_status'])) {
    $trangthai = $_POST['trangthai'];
    if ($trangthai !== '') {
        // Thêm điều kiện lọc theo trạng thái
        $sql_lietke .= " AND tbl_xuat.trangthai = '$trangthai'";
    }
}

$sql_lietke .= " ORDER BY tbl_xuat.id_xuat DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Danh sách đơn xuất hàng (<?php echo $dem ?>)</h2>
</div>

<!-- Bảng danh sách đơn xuất hàng -->
<div class="" style="width:99%; margin-left:1%">
    <a href="index.php?action=quanlyxuat&query=them">
        <button class="btn btn-primary" style="margin: 1% 0 0; padding: 6px 18px; font-size:20px">Tạo đơn</button>
    </a>
    <hr style="margin-bottom: 1%; color:chocolate">
    <div style="width:100%;">
        <!-- Form lọc theo ngày và trạng thái thanh toán -->
        <form action="" method="POST" style="margin: 20px 0;">
            <div style=" ">
                <label for="from_date" style="font-weight: 600;">Từ ngày: </label>
                <input type="date" id="from_date" name="from_date">
                <label for="to_date" style="font-weight: 600;">Đến ngày: </label>
                <input type="date" id="to_date" name="to_date">

                <button style="margin-bottom: 4px; margin-left:3px" type="submit" class="btn btn-primary" name="filter_date"><i class="fa-solid fa-filter"></i></button>
            </div>

            <div style="margin-left:3rem">
                <label for="trangthai" style="font-weight: 600;">Trạng thái: </label>
                <select id="trangthai" name="trangthai" style="padding: 7px;">
                    <option value="">Tất cả</option>
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary" name="filter_status" style="margin-bottom: 5px;"><i class="fa-solid fa-filter"></i></button>

            <!-- Nút hủy lọc -->
            <a href="index.php?action=quanlyxuat&query=danhsach" class="btn btn-secondary" style="margin-left: 20px;">Hủy lọc</a>
        </form>
    </div>
    <table class="table table-hover table-bordered" style="padding: 20px;">
        <thead class="thead-dark" style="">
            <tr>
                <th scope="col" style="width:4%;text-align:center">ID</th>
                <th scope="col" style="width:10%;padding-left: 15px; ">Thời gian</th>
                <th scope="col" style="width:16%;padding-left: 15px; ">Nhân viên</th>
                <th scope="col" style="width:16%; padding-left: 15px;">Khách hàng</th>
                <th scope="col" style="width:20%;padding-left: 15px;">Tổng tiền</th>
                <th scope="col" style="width:15%;padding-left: 15px;">Trạng Thái</th>
                <th scope="col" style="width:15%; text-align:center">Quản lý</th>
            </tr>
        </thead>
        <tbody style="padding: 15px; font-size:19px; border:1px solid;">
            <?php
            $i = 0;

            while ($row_tam = mysqli_fetch_array($query_lietke)) {
                $tongtien = 0;
                // id đơn xuất
                $id_xuat = $row_tam['id_xuat'];
                $i++;
                $sql_detail = "SELECT *,tbl_cartdetail_xuat.soluong_xuat AS soluong_xuat 
                                FROM tbl_cartdetail_xuat, tbl_sanpham 
                                WHERE tbl_cartdetail_xuat.id_xuat = $id_xuat 
                                AND tbl_cartdetail_xuat.id_sanpham = tbl_sanpham.id_sanpham";
                $query_detail = mysqli_query($mysqli, $sql_detail);
                while ($row_detail = mysqli_fetch_array($query_detail)) {
                    $giasp = $row_detail['giasanpham'];
                    $thanhtien = $giasp * $row_detail['soluong_xuat'];
                    $tongtien += $thanhtien;
                }
            ?>
                <tr>
                    <td style="border-left:1px solid; text-align:center">
                        <?php echo $i ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['ngayxuat'] ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['ten_nv'] ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['tenkhachhang'] ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php if ($row_tam['trangthai'] == 1) {
                            echo '<b style="color:green;background-color: green; padding:2% 8%; margin-top: 10%; border-radius: 10px; color:white">Đã thanh toán</b>';
                        } else {
                            echo '<b style="color:green;background-color: #FC4712; padding:2% 3%; margin-top: 10%; border-radius: 10px; color:white">Chưa thanh toán</b>';
                        }
                        ?>
                    </td>
                    <td style="text-align: center;vertical-align: middle; border-right:1px solid">
                        <a href="index.php?action=quanlyxuat&query=chitiet&id=<?php echo $row_tam['id_xuat'] ?>">
                            <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px">Chi tiết</button>
                        </a>
                        <button class="btn btn-danger" style="margin-right:2%; padding: 6px 14px" onclick="confirmDelete(<?php echo $row_tam['id_xuat']; ?>)">Xoá đơn</button>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id) {
                        var result = confirm("Bạn có chắc chắn muốn xoá đơn hàng không?");
                        if (result) {
                            window.location.href = "modules/quanlyxuat/xuly.php?idxuat=" + id;
                        }
                    }
                </script>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<style>
    form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    form label {
        font-size: 18px;
        margin-right: 10px;
    }

    form input,
    form select {
        padding: 5px;
        font-size: 16px;
    }

    form button {
        padding: 6px 12px;
        font-size: 16px;
    }

    .fa-trash {
        font-size: 24px;
        transition: all ease 0.3s;
    }

    .fa-trash:hover {
        color: red;
        transform: scale(1.5);
    }

    table th {
        width: 16%;
    }
</style>