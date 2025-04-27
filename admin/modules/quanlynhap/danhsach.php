<head>
    <title>Danh sách đơn nhập</title>
</head>
<?php
// Đếm tổng số đơn nhập hàng
$sql_sanpham = "SELECT COUNT(id_nhap) AS dem FROM tbl_nhap";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem = $rows['dem'];

// Xử lý lọc
$sql_lietke = "SELECT * FROM tbl_nhap, tbl_ncc
               WHERE tbl_nhap.id_ncc = tbl_ncc.id_ncc ";

// Lọc theo ngày nếu có giá trị ngày
if (isset($_POST['filter_date'])) {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    if (!empty($from_date) && !empty($to_date)) {
        $sql_lietke .= " AND tbl_nhap.thoigian BETWEEN '$from_date' AND '$to_date'";
    }
}

// Lọc theo trạng thái thanh toán nếu có chọn trạng thái
if (isset($_POST['filter_status'])) {
    $trangthai = $_POST['trangthai'];
    if ($trangthai !== '') {
        // Thêm điều kiện lọc theo trạng thái
        $sql_lietke .= " AND tbl_nhap.trangthai = '$trangthai'";
    }
}

$sql_lietke .= " ORDER BY tbl_nhap.id_nhap DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Danh sách đơn nhập hàng (<?php echo $dem ?>)</h2>
</div>

<div class="" style="width:99%; margin-left:1%">
    <a href="index.php?action=quanlynhap&query=them">
        <button class="btn btn-primary font" style="margin: 1% 0 0; padding: 6px 18px; font-size:20px">Tạo đơn</button>
        <hr style="margin-bottom: 1%; color:chocolate">
    </a>

    <div style="margin-bottom: 20px; font-size: 18px">
        <!-- Form lọc theo ngày và trạng thái thanh toán -->
        <form action="" method="POST" style="display: flex; align-items: center; gap: 20px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="from_date" style="font-weight: 600;">Từ ngày: </label>
                <input type="date" id="from_date" name="from_date">
                <label for="to_date" style="font-weight: 600;">Đến ngày: </label>
                <input type="date" id="to_date" name="to_date">
                <button style="margin-bottom: 4px; margin-left:3px" type="submit" class="btn btn-primary" name="filter_date"><i class="fa-solid fa-filter"></i></button>
            </div>

            <div style="display: flex; align-items: center; gap: 10px; margin-left:30px">
                <label for="trangthai" style="font-weight: 600;">Trạng thái: </label>
                <select id="trangthai" name="trangthai" style="padding: 4px">
                    <option value="">Tất cả</option>
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
                </select>
                <button type="submit" class="btn btn-primary" name="filter_status" style="margin-bottom: 5px;"><i class="fa-solid fa-filter"></i></button>
            </div>
            <a href="index.php?action=quanlynhap&query=danhsach" class="btn btn-secondary" style="margin-left: 20px; margin-top: 0;">Hủy lọc</a>
        </form>

    </div>


    <table class="table table-hover table-bordered" style="padding: 20px;">
        <thead class="thead-dark font" style="padding: 15px; font-size:20px">
            <tr>
                <th scope="col" style="width:4%; padding:10px 15px">STT</th>
                <th scope="col" style="width:10% ; padding:10px 15px">Thời gian</th>
                <th scope="col" style="width:18% ; padding:10px 15px">Nhân viên</th>
                <th scope="col" style="width:20%; padding:10px 15px">Nhà cung cấp</th>
                <th scope="col" style="width:18%; padding:10px 15px">Tổng tiền</th>
                <th scope="col" style="width:15%; padding:10px 15px">Trạng Thái</th>
                <th scope="col" style="width:15%; padding:10px 15px; text-align:center">Quản lý</th>
            </tr>
        </thead>
        <tbody style="border:1px solid; font-size:20px;" class="font">
            <?php
            $i = 0;
            $tongtien = 0;
            $tongsp = 0;

            while ($row_tam = mysqli_fetch_array($query_lietke)) {
                $id_nhap = $row_tam['id_nhap'];
                $i++;
                $sql_detail = "SELECT * FROM tbl_cartdetail_nhap WHERE tbl_cartdetail_nhap.id_nhap = $id_nhap";
                $query_detail = mysqli_query($mysqli, $sql_detail);
                $tongtien = 0; // Đặt lại tổng tiền cho mỗi đơn nhập hàng
                while ($row_detail = mysqli_fetch_array($query_detail)) {
                    $giasp = $row_detail['gianhap'];
                    $thanhtien = $giasp * $row_detail['soluong'];
                    $tongtien += $thanhtien;
                    $tongsp += $row_detail['soluong'];
                }
            ?>
                <tr>
                    <td style="padding: 15px;">
                        <?php echo $i ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['thoigian'] ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['ten_nv'] ?>
                    </td>
                    <td style="padding: 15px;">
                        <?php echo $row_tam['tenncc'] ?>
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
                    <td style="text-align: center; vertical-align: middle;">
                        <a href="index.php?action=quanlynhap&query=chitiet&id=<?php echo $row_tam['id_nhap'] ?>">
                            <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px">Chi tiết</button>
                        </a>

                        <button class="btn btn-danger" style="margin-right:2%; padding: 6px 14px" onclick="confirmDelete(<?php echo $row_tam['id_nhap']; ?>)">Xoá đơn</button>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id) {
                        var result = confirm("Bạn có chắc chắn muốn xoá đơn hàng không?");
                        if (result) {
                            window.location.href = "modules/quanlynhap/xuly.php?idnhap=" + id;
                        }
                    }
                </script>
            <?php } ?>
        </tbody>
    </table>
</div>

<style>
    .fa-trash {
        font-size: 24px;
        transition: all ease 0.3s;
    }

    .fa-trash:hover {
        color: red;
        transform: scale(1.5);
    }
</style>