<head>
    <title>Admin</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Tạo đơn xuất hàng</h2>
</div>
<hr style="margin-left: 1%;">

<a href="index.php?action=quanlyxuat&query=danhsach">
    <button class="btn btn-success" style="margin: 0% 1% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</button>
</a>

<form class="" enctype="multipart/form-data" action="modules/quanlyxuat/xuly.php" method="POST">
    <div style=" width:90%; margin:auto; margin-bottom:2%; margin-top:1%">
        <div style=" color:blue">
            <h2 style="margin-left:5px">Đơn hàng</h2>
        </div>
        <div class="form_them_sp chitietxuat row g-3" style=" margin:auto;">
            <div class=" col-md-10">
                <label for="kh" class="form-label"><b>Khách hàng</b></label>
                <select id="kh" class="form-select" name="id_khachhang">
                    <?php
                    $sql_kh = "SELECT * FROM tbl_khachhang ORDER BY id_khachhang DESC";
                    $query_kh = mysqli_query($mysqli, $sql_kh);
                    while ($row_kh = mysqli_fetch_array($query_kh)) {
                    ?>
                        <option value="<?php echo $row_kh['id_khachhang'] ?>"><?php echo $row_kh['tenkhachhang'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <hr style="margin-bottom: 2%;">
            </div>
            <div class="col-md-3 gia_sp">
                <label for="inputtt" class="form-label"><b>Trạng thái</b></label>
                <select id="inputtt" class="form-select" name="tinhtrang">
                    <option value="1">Đã thanh toán</option>
                    <option value="0">Chưa thanh toán</option>
                </select>
                <hr>
            </div>

            <div class="col-md-3 ha_sp">
                <label for="image" class="form-label"><b>Ngày bán</b></label>
                <input class="form-control" id="image" type="date" name="ngayxuat">
                <div id="preview" style="margin-top: 2%;"></div>
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-3 ha_sp">
                <label for="nv" class="form-label"><b>Nhân viên xuất</b></label>
                <select id="nv" class="form-select" name="ten_nv">
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
                <hr style="margin-bottom: 5%;">
            </div>
        </div>
    </div>

    <!---------------------------------- chi tiết đơn -------------------------------------->
    <div style=" width:90%; margin:auto; margin-bottom:2%; margin-top:1%">
        <div style=" color:blue">
            <h2 style="margin-left:5px">Chi tiết đơn hàng</h2>
        </div>
        <div class="form_them_sp chitietxuat row g-3" style=" margin:auto;">
            <div class="col-md-6">
                <label for="sp" class="form-label"><b>Sản phẩm</b></label>
                <!-- <input type="text" required='true' class="form-control" id="inputEmail4" name="tensanpham" placeholder="Nhập"> -->
                <select id="sp" class="form-select" name="id_sanpham" style="font-size: 19px;">
                    <?php
                    $sql_sp = "SELECT * FROM tbl_sanpham WHERE tinhtrang = 1 AND giasanpham != 0 ORDER BY id_sanpham DESC";
                    $query_sp = mysqli_query($mysqli, $sql_sp);
                    while ($row_sp = mysqli_fetch_array($query_sp)) {
                    ?>
                        <option value="<?php echo $row_sp['id_sanpham'] ?>">Mã: <?php echo $row_sp['id_sanpham'] ?> ___ <?php echo $row_sp['tensanpham'] ?> </option>
                    <?php
                    }
                    ?>
                </select>
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-3 gia_sp">
                <label for="sl" class="form-label"><b>Số lượng</b></label>
                <input type="number" class="form-control" id="sl" name="soluong" placeholder="nhập">
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-1 gia_sp">
                <label for="adspd" class="form-label"><b>Action</b></label>
                <button type="submit" class="btn btn-primary form-control" name="addxuat" style="font-size: 18px;">Thêm</button>
                <hr style="margin-bottom: 5%;">
            </div>

            <!-- danh sách sản phẩm -->
            <div class="table-responsive lk_sp">
                <table class="table table-hover table-bordered" style="padding: 20px; vertical-align: middle;">
                    <thead class="thead-dark" style="">
                        <tr>
                            <th scope="col" style="width:4%; text-align:center">STT</th>
                            <th scope="col" style="width:41%">Sản phẩm</th>
                            <th scope="col" style="width:15%">Giá sản phẩm</th>
                            <th scope="col" style="width:8%">Số lượng</th>
                            <th scope="col" style="width:20%">Thành tiền</th>
                            <th scope="col" style="width:12%; text-align:center">Quản lý</th>
                        </tr>
                    </thead>
                    <tbody style="padding: 16px; font-size:19px;">
                        <?php
                        $sql_tam = "SELECT *, tbl_xuat_tam.soluong AS soluong_tam FROM tbl_xuat_tam, tbl_sanpham WHERE tbl_xuat_tam.id_sanpham = tbl_sanpham.id_sanpham ORDER BY id_xuat_tam DESC";
                        $query_tam = mysqli_query($mysqli, $sql_tam);
                        $i = 0;
                        $tongtien = 0;
                        $tongsp = 0;
                        while ($row_tam = mysqli_fetch_array($query_tam)) {
                            $giasp = $row_tam['giasanpham'];
                            $thanhtien = $giasp * $row_tam['soluong_tam'];
                            $tongtien += $thanhtien;
                            $tongsp += $row_tam['soluong_tam'];
                            $i++;

                        ?>
                            <tr>
                                <td style="text-align:center">
                                    <?php echo $i ?>
                                </td>
                                <td style="padding-left: 15px">
                                    <?php echo $row_tam['tensanpham'] ?>
                                </td>
                                <td style="padding-left: 15px">
                                    <?php echo number_format($row_tam['giasanpham'], 0, ',', '.') . ' vnđ' ?>
                                </td>
                                <td style="padding-left: 15px">
                                    <?php echo $row_tam['soluong_tam'] ?>
                                </td>
                                <td style="padding-left: 15px">
                                    <?php echo number_format($thanhtien, 0, ',', '.') . ' vnđ' ?>
                                </td>
                                <td style="text-align: center;vertical-align: middle;">
                                    <i class="fa-solid fa-trash" onclick="confirmDelete(<?php echo $row_tam['id_xuat_tam']; ?>)"></i>
                                </td>
                            </tr>
                            <script>
                                function confirmDelete(id) {
                                    var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm không?");
                                    if (result) {
                                        window.location.href = "modules/quanlyxuat/xuly.php?idtam=" + id;
                                    }
                                }
                            </script>
                        <?php } ?>


                        <!-- tổng -->
                        <tr>
                            <td colspan="4" style="text-align: center; vertical-align: middle;">Tổng số lượng: <?php echo $tongsp ?> </td>
                            <!-- <td style="padding-left: 15px"></td> -->
                            <td style="padding-left: 15px; vertical-align: middle;">Tổng tiền: <?php echo number_format($tongtien, 0, ',', '.') . ' vnđ' ?></td>
                            <td>
                                <button class="btn btn-danger form-control" onclick="confirmDelete1()" name="xoaall">Xoá tất cả SP</button>
                            </td>
                        </tr>
                        <script>
                            function confirmDelete1() {
                                var result = confirm("Bạn có chắc chắn muốn xoá tất cả sản phẩm không?");
                                if (result) {
                                    window.location.href = "modules/quanlyxuat/xuly.php?xoaall";
                                }
                            }
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-12 tdon" style="text-align: center;">
        <button type="submit" class="btn btn-primary" name="taodonxuat" style="padding: 6px 18px; font-size:18px">Tạo đơn</button>
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