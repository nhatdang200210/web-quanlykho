<head>
    <title>Admin</title>
</head>

<?php
$sql = "SELECT * FROM tbl_khachhang WHERE id_khachhang = '$_GET[idkhachhang]' ORDER BY id_khachhang LIMIT 1";
$query = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($query)
?>


<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Sửa thông tin khách hàng </h2>
</div>
<hr style="margin-left: 1%;" color="red">

<div style="padding-bottom: 1%; padding-left: 1%" class="font">
    <a href="<?php echo './index.php?action=quanlytaikhoan&query=lietke' ?>"><i class="fa-solid fa-reply"></i> Trở lại</a>
</div>


<div class="form_them font" style="margin-top: 1%; padding: 2% 25%; font-size:20px">
    <form class="row g-3" enctype="multipart/form-data" action="modules/quanlytaikhoan/xuly.php?idkhachhang=<?php echo $_GET['idkhachhang'] ?>" method="POST">
        <div class="col-md-10 ten_sp">
            <label for="inputEmail4" class="form-label"><b>Tên khách hàng</b></label>
            <input type="text" required='true' class="form-control" id="inputEmail4" name="tenkhachhang" placeholder="Nhập" value="<?php echo $row['tenkhachhang'] ?>">
            <!-- <input name="idkhachhang" value="<?php echo $row['id_khachhang'] ?>"> -->
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="inputPassword4" class="form-label"><b>Số điện thoại</b></label>
            <input type="number" required='true' class="form-control" id="inputPassword4" name="sdt" placeholder="nhập" maxlength="10" value="0<?php echo $row['sdt'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="noinhap" class="form-label"><b>Email</b></label>
            <input type="email" required='true' class="form-control" id="noinhap" name="email" placeholder="nhập" value="<?php echo $row['email'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="dc" class="form-label"><b>Địa chỉ</b></label>
            <input type="text" required='true' class="form-control" id="dc" name="diachi" placeholder="nhập" value="<?php echo $row['diachi'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-12 tdon" style="width: 15%; margin:auto">
            <button type="submit" class="btn btn-primary" name="suakhachhang" style="padding: 5px 18px; font-size:19px;">Sửa thông tin</button>
        </div>
    </form>
</div>
<style>

</style>