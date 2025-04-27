<head>
    <title>Admin - Sửa nhân viên</title>
</head>

<?php
$sql_sua_sanpham = "SELECT * FROM tbl_admin WHERE id_admin='$_GET[idnv]' LIMIT 1";
// $query_sua_sanpham = mysqli_query($mysqli,$sql_sua_sanpham);

$query_sanpham = mysqli_query($mysqli, $sql_sua_sanpham);
$rows = mysqli_fetch_array($query_sanpham);

// $sql_lay_danhmuc = "SELECT id_danhmuc FROM tbl_sanpham WHERE id_sanpham = $_GET[idsanpham] LIMIT 1";
// $query_lay_danhmuc = mysqli_query($mysqli, $sql_lay_danhmuc);
// $row_lay_danhmuc = mysqli_fetch_array($query_lay_danhmuc);
// $id_danhmuc_sua = $row_lay_danhmuc['id_danhmuc'];

?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Sửa thông tin viên quản lý</h2>
</div>
<hr style="margin-left: 1%;" color="red">

<!-- <a href="index.php?action=quanlynv&query=lietke">
    <button class="btn btn-success" style="margin: 0% 1% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</button>
</a> -->

<div class="form_them" style=" padding: 2% 0">
    <div style=" width: 50%; margin: auto">
        <form class="row g-3" enctype="multipart/form-data" action="modules/quanlynv/xuly.php?idnv=<?php echo $_GET['idnv'] ?>" method="POST">
            <div class="col-md-10 sl_sp">
                <label for="inputEmail4" class="form-label"><b>Tên nhân viên</b></label>
                <input type="text" required='true' class="form-control" id="inputEmail4" name="tennv" placeholder="Nhập" value="<?php echo $rows['tennv'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-md-10 sl_sp">
                <label for="inputPassword4" class="form-label"><b>Mã nhân viên</b></label>
                <input type="text" required='true' class="form-control" id="inputPassword4" name="manv" placeholder="nhập" value="<?php echo $rows['manv'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-md-10 sl_sp">
                <label for="dc" class="form-label"><b>Địa chỉ</b></label>
                <input type="text" required='true' class="form-control" id="dc" name="dc" placeholder="Nhập" value="<?php echo $rows['diachi'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-md-10 sl_sp">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="text" required='true' class="form-control" id="email" name="email" placeholder="Nhập" value="<?php echo $rows['username'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-md-10 sl_sp">
                <label for="lh" class="form-label"><b>Số điện thoại</b></label>
                <input type="number" required='true' maxlength="10" class="form-control" id="lh" name="sdt" placeholder="Nhập" value="0<?php echo $rows['sdt'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-md-10 sl_sp">
                <label for="pass" class="form-label"><b>Mật khẩu</b></label>
                <input type="text" required='true' class="form-control" id="pass" name="pass" placeholder="Nhập" value="<?php echo $rows['password'] ?>">
                <hr style="margin-bottom: 3%;">
            </div>

            <div class="col-12 tdon" style="text-align: center;">
                <button type="submit" class="btn btn-primary" style="font-size: 20px;" name="suanv">Cập nhật</button>
                <button class="btn btn-danger hv" name="huy" style="font-size: 20px; margin-left: 15px">Huỷ</button>
            </div>
        </form>
    </div>
    <style>
        label {
            font-size: 19px;
        }
    </style>