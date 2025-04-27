<head>
    <title>Sửa nhà cung cấp</title>
</head>

<?php
$sql_lietke = "SELECT * FROM tbl_ncc WHERE id_ncc = '$_GET[idncc]' ";
$query_lietke = mysqli_query($mysqli, $sql_lietke);
$row = mysqli_fetch_array($query_lietke);
?>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Sửa thông tin nhà cung cấp <b style="color: blue;">"<?php echo $row['tenncc'] ?>"</b></h2>
</div>
<hr style="margin-left: 1%;" color="red">


<div class="form_them" style=" padding: 2% 0">
    <div style=" width: 43%; margin: auto; font-size:20px">
        <form class="row g-3" enctype="multipart/form-data" action="modules/quanlyncc/xuly.php?idncc=<?php echo $_GET['idncc'] ?>" method="POST">
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label"><b>Tên nhà cung cấp</b></label>
                <input type="text" required='true' class="form-control" id="inputEmail4" name="tenncc" placeholder="Nhập" value="<?php echo $row['tenncc'] ?>">
                <hr style=" margin-bottom: 5%;">
            </div>

            <div class=" col-md-12">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="text" required='true' class="form-control" id="email" name="email" placeholder="nhập" value="<?php echo $row['email_ncc'] ?>">
                <hr>
            </div>

            <div class="col-md-12">
                <label for="dt" class="form-label"><b>Điện thoại</b></label>
                <input type="number" required='true' class="form-control" id="dt" name="sdt" placeholder="nhập" value="<?php echo $row['sdt_ncc'] ?>">
                <hr>
            </div>


            <div class="col-md-12">
                <label for="dc" class="form-label"><b>Địa chỉ</b></label>
                <input type="text" required='true' class="form-control" id="dc" name="diachi" placeholder="nhập" value="<?php echo $row['diachi_ncc'] ?>">
                <hr>
            </div>

            <div class="col-12 tdon" style="text-align: center;">
                <button type="submit" class="btn btn-primary" name="suancc" style="font-size: 20px;">Cập nhật</button>
                <button type="submit" class="btn btn-danger hv" name="huy" style="font-size: 20px; margin-left: 15px">Huỷ</button>
            </div>
        </form>
    </div>
</div>
<style>
    input {
        font-size: 19px !important;
    }

    button.hv:hover {
        background-color: red;
    }
</style>