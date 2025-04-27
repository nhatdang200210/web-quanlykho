<head>
    <title>Admin - chi tiết đơn</title>
</head>

<?php
$sql_detail = "SELECT *, tbl_cartdetail_xuat.soluong_xuat AS soluong_xuat FROM tbl_cartdetail_xuat, tbl_sanpham
                WHERE tbl_cartdetail_xuat.id_sanpham = tbl_sanpham.id_sanpham AND tbl_cartdetail_xuat.id_xuat = '$_GET[id]'";
$query_detail = mysqli_query($mysqli, $sql_detail);

// $query_id = mysqli_query($mysqli, $sql_detail);
// $row_id = mysqli_fetch_array($query_id);
$id_xuat = $_GET['id'];

?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Chi tiết đơn xuất (mã: <?php echo $id_xuat ?>)</h2>
</div>

<div style="padding-bottom: 1%; padding-left: 1%">
    <a href="<?php echo './index.php?action=quanlyxuat&query=danhsach' ?>"><i class="fa-solid fa-arrow-left" style="font-size: 30px; color:black; font-weight:bold"></i></a>
</div>

<div class="allct">
    <div class="chitietxuat">
        <div style=" color:blue; background-color:#ececec; padding: 12px 3% 3px">
            <h2 style="margin-left:5px">Thông tin đơn xuất hàng</h2>
        </div>

        <div class="form_them_sp row g-3" style=" margin:auto;">
            <table class="table table-hover table-bordered" style="padding: 20px;">
                <thead class="thead-dark" style="">
                    <tr>
                        <th scope="col" style="width:5%">ID</th>
                        <th scope="col" style="width:20%">Ngày xuất</th>
                        <th scope="col" style="width:25%">Khách hàng</th>
                        <th scope="col" style="width:25%">Tổng tiền</th>
                        <th scope="col" style="width:25%">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody style=" font-size:19px; border: 1px solid">
                    <?php
                    $tongtien = 0;
                    $tongsp = 0;
                    $sql_xuat = "SELECT * FROM tbl_xuat, tbl_khachhang WHERE  tbl_xuat.id_khachhang = tbl_khachhang.id_khachhang AND tbl_xuat.id_xuat = $id_xuat";
                    $query_xuat = mysqli_query($mysqli, $sql_xuat);

                    while ($row_xuat = mysqli_fetch_array($query_xuat)) {
                        // id đơn xuất
                        // $id_xuat = $row_xuat['id_xuat'];

                        $sql_detail_xuat = "SELECT *,tbl_cartdetail_xuat.soluong_xuat AS soluong_xuat 
                                FROM tbl_cartdetail_xuat, tbl_sanpham 
                                WHERE tbl_cartdetail_xuat.id_xuat = $id_xuat 
                                AND tbl_cartdetail_xuat.id_sanpham = tbl_sanpham.id_sanpham";
                        $query_detail_xuat = mysqli_query($mysqli, $sql_detail_xuat);

                        while ($row_detail_xuat = mysqli_fetch_array($query_detail_xuat)) {
                            $giasp = $row_detail_xuat['giasanpham'];
                            $thanhtien = $giasp * $row_detail_xuat['soluong_xuat'];
                            $tongtien += $thanhtien;
                        }
                    ?>
                        <tr style="border:1px solid">
                            <td style="padding: 16px;">
                                <?php echo $row_xuat['id_xuat'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo $row_xuat['ngayxuat'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo $row_xuat['tenkhachhang'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php if ($row_xuat['trangthai'] == 1) {
                                    echo '<b style="color:green;background-color: green; padding:2% 8%; margin-top: 10%; border-radius: 10px; color:white">Đã thanh toán</b>';
                                } else {
                                    echo '<b style="color:green;background-color: #FC4712; padding:2% 3%; margin-top: 10%; border-radius: 10px; color:white">Chưa thanh toán</b>';
                                }
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="chitietxuat" style="margin-top: 3%;">
        <div style=" color:blue; background-color:#ececec; padding: 12px 3% 3px">
            <h2 style="margin-left:5px">Chi tiết đơn hàng</h2>
        </div>

        <div class="form_them_sp row g-3" style=" margin:auto;">
            <table class="table table-hover table-bordered" style="padding: 20px;">
                <thead class="thead-dark" style="">
                    <tr>
                        <th scope="col" style="width:5%;text-align: center;">STT</th>
                        <th scope="col" style="width:47%;padding-left: 15px ">Sản Phẩm</th>
                        <th scope="col" style="width:20%; padding-left: 15px">Đơn giá</th>
                        <th scope="col" style="width:8%; padding-left: 15px">Số lượng</th>
                        <th scope="col" style="width:20%; padding-left: 15px">Thành tiền</th>
                    </tr>
                </thead>
                <tbody style="padding: 16px; font-size:19px; border: 1px solid">
                    <tr style="border:1px solid">
                        <?php
                        $i = 0;
                        $tongtien = 0;
                        $tongsp = 0;
                        while ($row_detail = mysqli_fetch_array($query_detail)) {
                            $giasp = $row_detail['giasanpham'];
                            $thanhtien = $giasp * $row_detail['soluong_xuat'];
                            $tongtien += $thanhtien;
                            $tongsp += $row_detail['soluong_xuat'];
                            $i++;

                        ?>
                            <td style="text-align: center;">
                                <?php echo $i ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo $row_detail['tensanpham'] ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo number_format($row_detail['giasanpham'], 0, ',', '.') . ' vnđ' ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo $row_detail['soluong_xuat'] ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo number_format($thanhtien, 0, ',', '.') . ' vnđ' ?>
                            </td>
                    </tr>
                <?php
                        }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    $sql_color = "SELECT * FROM tbl_xuat WHERE id_xuat = '$id_xuat'";
    $query_color = mysqli_query($mysqli, $sql_color);
    $color = mysqli_fetch_array($query_color);

    ?>
    <form class="" enctype="multipart/form-data" action="modules/quanlyxuat/xuly.php" method="POST">
        <div style=" margin-top:2%; padding-left: 1%">
            <div>
                <input type="hidden" value="<?php echo $id_xuat ?>" name="idxuat">
                <?php
                if ($color['trangthai'] == 1) {
                ?>
                    <button class="btn btn-primary a" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="dathanhtoan">
                        Đã thanh toán
                    </button>
                    <button class="btn btn-outline-primary" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="chuathanhtoan">Chưa thanh toán</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-outline-primary a" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="dathanhtoan">
                        Đã thanh toán
                    </button>
                    <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="chuathanhtoan">Chưa thanh toán</button>
                <?php
                }
                ?>
            </div>
        </div>
    </form>
</div>
<style>

</style>