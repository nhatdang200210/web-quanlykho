<head>
    <title>Tạo đơn nhập hàng</title>
</head>
<?php
$sql_lietke = "SELECT * FROM tbl_cartdetail_tam ORDER BY id_tam DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
?>
<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Tạo đơn nhập hàng</h2>
</div>
<hr style="margin-left: 1%;">

<a href="index.php?action=quanlynhap&query=danhsach">
    <button class="btn btn-success font" style="margin: 0% 1% 1%; padding: 6px 18px; font-size:20px">Danh sách</button>
</a>
<form class="" enctype="multipart/form-data" action="modules/quanlynhap/xuly.php" method="POST">

    <div style=" width:90%; margin:auto; margin-bottom:2%; margin-top:1%; font-size:20px" class="font">
        <div style=" color:blue">
            <h2 style="margin-left:5px">Đơn hàng</h2>
        </div>
        <div class="form_them_sp chitietxuat row g-3" style=" margin:auto;">
            <div class=" col-md-12">
                <label for="noinhap" class="form-label"><b>Nhà cung cấp</b></label>
                <select id="noinhap" class="form-select" name="ncc">
                    <?php
                    $sql_ncc = "SELECT * FROM tbl_ncc ORDER BY id_ncc DESC";
                    $query_ncc = mysqli_query($mysqli, $sql_ncc);
                    while ($row_ncc = mysqli_fetch_array($query_ncc)) {
                    ?>
                        <option value="<?php echo $row_ncc['id_ncc'] ?>"><?php echo $row_ncc['tenncc'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <hr style="margin-bottom: 2%;">
            </div>
            <div class="col-md-4 gia_sp">
                <label for="inputtt" class="form-label"><b>Trạng thái</b></label>
                <select id="inputtt" class="form-select" name="tinhtrang">
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
                </select>
                <hr>
            </div>

            <div class="col-md-3 ha_sp">
                <label for="image" class="form-label"><b>Ngày nhập</b></label>
                <input class="form-control" id="image" type="date" name="ngaynhap">
                <div id="preview" style="margin-top: 2%;"></div>
                <hr style="margin-bottom: 5%;">
            </div>
            <div class=" col-md-3 gia_sp">
                <label for="nv" class="form-label"><b>Nhân viên</b></label>
                <select id="nv" class="form-select" name="nv">
                    <?php
                    $sql_nv = "SELECT * FROM tbl_admin WHERE admin_status = 1 ORDER BY id_admin DESC";
                    $query_nv = mysqli_query($mysqli, $sql_nv);
                    while ($row_nv = mysqli_fetch_array($query_nv)) {
                    ?>
                        <option value="<?php echo $row_nv['tennv'] ?>"><?php echo $row_nv['tennv'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <hr style="margin-bottom: 2%;">
            </div>
        </div>
    </div>

    <!-- chi tiết đơn -->
    <!-- <h2>Chi tiết đơn</h2> -->
    <div style=" width:90%; margin:auto; margin-bottom:2%; margin-top:1%; font-size:20px" class="font">
        <div style=" color:blue">
            <h2 style="margin-left:5px">Chi tiết đơn hàng</h2>
        </div>
        <div class="form_them_sp chitietxuat row g-3" style=" margin:auto;">

            <div class="col-md-5 ">
                <label for="inputEmail4" class="form-label"><b>Sản phẩm</b></label>
                <input type="text" class="form-control" id="inputEmail4" name="tensanpham" placeholder="Nhập">
                <hr style="margin-bottom: 5%;">
            </div>
            <div class="col-md-3 gia_sp">
                <label for="gianhap" class="form-label"><b>Giá nhập</b></label>
                <input type="number" class="form-control" id="gianhap" name="gianhap" placeholder="nhập">
                <hr>
            </div>

            <div class="col-md-3 gia_sp">
                <label for="sl" class="form-label"><b>Số lượng</b></label>
                <input type="number" class="form-control" id="sl" name="soluong" placeholder="nhập">
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-1 gia_sp">
                <label for="adspd" class="form-label"><b>Action</b></label>
                <button type="submit" class="btn btn-primary form-control" name="addsp">Thêm</button>
                <hr style="margin-bottom: 5%;">
            </div>

            <!-- danh sách sản phẩm -->
            <div class="table-responsive lk_sp">
                <table class="table table-hover table-bordered" style="padding: 20px;">

                    <thead class="thead-dark" style="">
                        <tr>
                            <th scope="col" style="width:4%">STT</th>
                            <th scope="col" style="width:50%">Sản phẩm</th>
                            <th scope="col" style="width:19%">Giá sản phẩm</th>
                            <th scope="col" style="width:13%">Số lượng</th>
                            <th scope="col" style="width:14%; text-align:center">Quản lý</th>
                        </tr>
                    </thead>
                    <?php
                    $i = 0;
                    $tongtien = 0;
                    $tongsp = 0;
                    while ($row_tam = mysqli_fetch_array($query_lietke)) {
                        $giasp = $row_tam['gianhap'];
                        $thanhtien = $giasp * $row_tam['soluong'];
                        $tongtien += $thanhtien;
                        $tongsp += $row_tam['soluong'];
                        $i++;

                    ?>
                        <tbody style="padding: 15px; font-size:18px">
                            <tr>
                                <td>
                                    <?php echo $i ?>
                                </td>
                                <td>
                                    <?php echo $row_tam['tensanpham'] ?>
                                </td>
                                <td>
                                    <?php echo number_format($row_tam['gianhap'], 0, ',', '.') . ' vnđ' ?>
                                </td>
                                <td>
                                    <?php echo $row_tam['soluong'] ?>
                                </td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <i class="fa-solid fa-trash" onclick="confirmDelete(<?php echo $row_tam['id_tam']; ?>)"></i>
                                </td>
                            </tr>
                            <script>
                                function confirmDelete(id) {
                                    var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm không?");
                                    if (result) {
                                        window.location.href = "modules/quanlynhap/xuly.php?idtam=" + id;
                                    }
                                }
                            </script>
                        <?php } ?>
                        <!-- tổng -->
                        <tr>
                            <td style="text-align: center;" colspan="2"></td>
                            <td><b>Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?><b></td>
                            <td><b>Tổng số lượng: <?php echo $tongsp ?><b></td>
                            <td>
                                <button class="btn btn-danger form-control" name="xoaall">Xoá tất cả SP</button>
                            </td>
                            <!-- <td style="text-align: center;"><button type="submit" class="btn btn-danger" name="taodonnhap" style="padding: 6px 18px; font-size:18px">Xoá all</button></td> -->
                        </tr>
                        </tbody>
                        <!-- <script>
                            function confirmDelete1() {
                                var result = confirm("Bạn có chắc chắn muốn xoá tất cả sản phẩm không?");
                                if (result) {
                                    window.location.href = "modules/quanlynhap/xuly.php?xoaall";
                                }
                            }
                        </script> -->
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 tdon" style="text-align: center;">
        <button type="submit" class="btn btn-primary font" name="taodonnhap" style="padding: 6px 18px; font-size:20px">Tạo đơn</button>
    </div>
</form>
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