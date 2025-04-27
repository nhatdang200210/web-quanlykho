<head>
    <title>Admin - Sửa danh mục</title>
</head>
<?php
$sql_sua_danhmucsp = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc='$_GET[iddanhmucsp]' LIMIT 1";
$query_sua_danhmucsp = mysqli_query($mysqli, $sql_sua_danhmucsp);

$query_sua = mysqli_query($mysqli, $sql_sua_danhmucsp);
$row = mysqli_fetch_array($query_sua)
?>
<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Sửa danh mục</h2>
</div>
<hr style="margin-right: 10px;" color="red">
<div class="form_them">
    <form method="POST" action="modules/quanlydanhmuc/xuly.php?iddanhmucsp=<?php echo $_GET['iddanhmucsp'] ?>">
        <?php
        while ($dong = mysqli_fetch_array($query_sua_danhmucsp)) {
        ?>
            <div class="form-group font" style="padding:4% 5% 0">
                <label for="formGroupExampleInput" class="form-label " style="font-size: 20px;"><b>Tên danh mục</b></label>
                <input required="true" type="text" name="tendanhmuc" class="form-control" id="formGroupExampleInput" value="<?php echo $dong['tendanhmuc'] ?>" style="font-weight: 700;">
            </div>

            <div class="nut_them font">
                <!-- <input class="nut" type="submit" name="suadanhmuc" value="Sửa danh mục"> -->
                <button class="btn btn-primary nut" style="margin:auto; padding: 6px 18px; font-size:20px" type="submit" name="suadanhmuc">Cập nhật</button>
                <button type="submit" class="btn btn-danger hv" name="huy" style="font-size: 20px; margin-left: 15px">Huỷ</button>
            </div>
        <?php
        }
        ?>
    </form>
</div>
<style>
    .form_them {
        width: 50%;
        margin: auto;
        padding-bottom: 1%;
    }


    .nut:hover {
        background-color: green;
        transform: scale(1.1);
    }

    .nut_them {
        padding-top: 4%;
        text-align: center;
        margin: auto;
        width: 100%;
        /* border: 1px solid; */
    }
</style>