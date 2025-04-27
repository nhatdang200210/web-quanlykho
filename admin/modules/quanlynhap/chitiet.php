<head>
    <title>Chi tiết đơn</title>
</head>
<?php
$id_nhap = $_GET['id'];

$sql_detail = "SELECT * FROM tbl_cartdetail_nhap WHERE tbl_cartdetail_nhap.id_nhap = '$_GET[id]'";
$query_detail = mysqli_query($mysqli, $sql_detail);

$query_id = mysqli_query($mysqli, $sql_detail);
$row_id = mysqli_fetch_array($query_id);
$id_detail = $row_id['id_nhap'];
?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Chi tiết đơn nhập (mã: <?php echo $id_detail ?>)</h2>
</div>

<div style="padding-bottom: 1%; padding-left: 1%" class="font">
    <a href="<?php echo './index.php?action=quanlynhap&query=danhsach' ?>"><i class="fa-solid fa-arrow-left" style="font-size: 30px; color:black; font-weight:bold"></i></a>
</div>
<div class="allct">
    <div class="chitietxuat">
        <div style=" color:blue; background-color:#ececec; padding: 12px 3% 3px">
            <h2 style="margin-left:5px">Thông tin đơn nhập hàng</h2>
        </div>

        <div class="form_them_sp row g-3" style=" margin:auto;">
            <table class="table table-hover table-bordered" style="padding: 20px;">
                <thead class="thead-dark font" style="font-size:20px">
                    <tr>
                        <th scope="col" style="width:5%">ID</th>
                        <th scope="col" style="width:20%">Ngày nhập</th>
                        <th scope="col" style="width:25%">Nhà cung cấp</th>
                        <th scope="col" style="width:25%">Tổng tiền</th>
                        <th scope="col" style="width:25%">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody style=" font-size:19px; border: 1px solid; font-size:20px" class="font">
                    <?php
                    $tongtien = 0;
                    $tongsp = 0;
                    $sql_nhap = "SELECT * FROM tbl_nhap, tbl_ncc WHERE tbl_nhap.id_ncc = tbl_ncc.id_ncc AND id_nhap = '$id_nhap'";
                    $query_nhap = mysqli_query($mysqli, $sql_nhap);

                    while ($row_nhap = mysqli_fetch_array($query_nhap)) {

                        $sql_detail_nhap = "SELECT * FROM tbl_cartdetail_nhap WHERE tbl_cartdetail_nhap.id_nhap = '$id_nhap' ";
                        $query_detail_nhap = mysqli_query($mysqli, $sql_detail_nhap);

                        while ($row_detail_nhap = mysqli_fetch_array($query_detail_nhap)) {
                            $giasp = $row_detail_nhap['gianhap'];
                            $thanhtien = $giasp * $row_detail_nhap['soluong'];
                            $tongtien += $thanhtien;
                        }
                    ?>
                        <tr style="border:1px solid">
                            <td style="padding: 16px;">
                                <?php echo $row_nhap['id_nhap'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo $row_nhap['thoigian'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo $row_nhap['tenncc'] ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?>
                            </td>
                            <td style="padding: 16px;">
                                <?php if ($row_nhap['trangthai'] == 1) {
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
                <thead class="thead-dark font" style="font-size:20px">
                    <tr>
                        <th scope="col" style="width:5%;text-align: center;">STT</th>
                        <th scope="col" style="width:47%;padding-left: 15px ">Sản phẩm</th>
                        <th scope="col" style="width:20%; padding-left: 15px">Đơn giá</th>
                        <th scope="col" style="width:8%; padding-left: 15px">Số lượng</th>
                        <th scope="col" style="width:20%; padding-left: 15px">Thành tiền</th>
                    </tr>
                </thead>
                <tbody style="padding: 16px; font-size:19px; border: 1px solid">
                    <tr style="border:1px solid" class="font">
                        <?php
                        $i = 0;
                        $tongtien = 0;
                        $tongsp = 0;
                        while ($row_detail = mysqli_fetch_array($query_detail)) {
                            $giasp = $row_detail['gianhap'];
                            $thanhtien = $giasp * $row_detail['soluong'];
                            $tongsp += $row_detail['soluong'];
                            $i++;

                        ?>
                            <td style="text-align: center;">
                                <?php echo $i ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo $row_detail['tensanpham'] ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo number_format($row_detail['gianhap'], 0, ',', '.') . ' vnđ' ?>
                            </td>
                            <td style="padding-left: 15px">
                                <?php echo $row_detail['soluong'] ?>
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
    $sql_color = "SELECT * FROM tbl_nhap WHERE id_nhap = '$id_nhap'";
    $query_color = mysqli_query($mysqli, $sql_color);
    $color = mysqli_fetch_array($query_color);

    ?>
    <form class="" enctype="multipart/form-data" action="modules/quanlynhap/xuly.php" method="POST">
        <div style=" margin-top:2%; padding-left: 1%">
            <div style="font-size: 20px;" class="font">
                <input type="hidden" value="<?php echo $id_nhap ?>" name="idnhap">
                <?php
                if ($color['trangthai'] == 1) {
                ?>
                    <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="dathanhtoan">
                        Đã thanh toán
                    </button>
                    <button class="btn btn-outline-primary" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="chuathanhtoan">Chưa thanh toán</button>
                <?php
                } else {
                ?>
                    <button class="btn btn-outline-primary" style="margin-right:2%; padding: 6px 14px; font-size:18px;" type="submit" name="dathanhtoan">
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