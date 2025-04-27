<head>
    <title>Lịch sử giao dịch</title>
</head>
<?php
$sql_lietke = "SELECT * FROM tbl_nhap, tbl_ncc WHERE tbl_nhap.id_ncc = tbl_ncc.id_ncc AND tbl_ncc.id_ncc = '$_GET[idncc]' ORDER BY tbl_nhap.thoigian DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Danh sách đơn nhập hàng</h2>
</div>

<div class="" style="width:99%; margin-left:1%">
    <a href="index.php?action=quanlynhap&query=them">
        <button class="btn btn-primary font" style="margin: 1% 0; padding: 6px 18px; font-size:20px">Thêm</button>
    </a>
    <table class="table table-hover table-bordered" style="padding: 20px;">
        <thead class="thead-dark font" style="padding: 15px; font-size:20px">
            <tr>
                <th scope="col" style="width:4%; padding:10px 15px">STT</th>
                <th scope="col" style="width:16% ; padding:10px 15px">Thời gian</th>
                <th scope="col" style="width:25%; padding:10px 15px">Nhà cung cấp</th>
                <th scope="col" style="width:20%; padding:10px 15px">Tổng tiền</th>
                <th scope="col" style="width:15%; padding:10px 15px">Trạng Thái</th>
                <th scope="col" style="width:15%; padding:10px 15px; text-align:center"></th>
            </tr>
        </thead>
        <tbody style="border:1px solid; font-size:20px; " class="font">
            <?php
            $i = 0;
            $tongtien = 0;
            $tongsp = 0;
            if (mysqli_num_rows($query_lietke) > 0) {
                while ($row_tam = mysqli_fetch_array($query_lietke)) {
                    $id_nhap = $row_tam['id_nhap'];
                    $i++;
                    $sql_detail = "SELECT * FROM tbl_cartdetail_nhap WHERE tbl_cartdetail_nhap.id_nhap = $id_nhap";
                    $query_detail = mysqli_query($mysqli, $sql_detail);

                    while ($row_detail = mysqli_fetch_array($query_detail)) {
                        $giasp = $row_detail['gianhap'];
                        $thanhtien = $giasp * $row_detail['soluong'];
                        $tongtien += $thanhtien;
                        $tongsp += $row_detail['soluong'];
                    }
            ?>
                    <tr>
                        <td style="padding: 15px; ">
                            <?php echo $i ?>
                        </td>
                        <td style="padding: 15px;">
                            <?php echo $row_tam['thoigian'] ?>
                        </td>
                        <td style="padding: 15px; ">
                            <?php echo $row_tam['tenncc'] ?>
                        </td>
                        <td style="padding: 15px; ">
                            <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?>
                        </td>
                        <td style="padding: 15px; ">
                            <?php if ($row_tam['trangthai'] == 1) {
                                echo '<b style="color:green;background-color: green; padding:2% 8%; margin-top: 10%; border-radius: 10px; color:white">Đã thanh toán</b>';
                            } else {
                                echo '<b style="color:green;background-color: #FC4712; padding:2% 3%; margin-top: 10%; border-radius: 10px; color:white">Chưa thanh toán</b>';
                            }
                            ?>
                        </td>
                        <td style="text-align: center;vertical-align: middle;">
                            <a href="index.php?action=quanlynhap&query=chitiet&id=<?php echo $row_tam['id_nhap'] ?>">
                                <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px">Chi tiết</button>
                            </a>

                            <button class="btn btn-danger" style="margin-right:2%; padding: 6px 14px" onclick="confirmDelete(<?php echo $row_tam['id_nhap']; ?>)">Xoá</button>
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
                <?php }
            } else {
                ?>
                <td colspan="6" style="text-align: center;">
                    Chưa có giao dịch nào với nhà cung cấp này
                </td>
            <?php
            }
            ?>
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