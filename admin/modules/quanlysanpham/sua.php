<head>
    <title>Admin - Sửa sản phẩm</title>
</head>

<?php
$sql_sua_sanpham = "SELECT * FROM tbl_sanpham WHERE id_sanpham='$_GET[idsanpham]' LIMIT 1";
// $query_sua_sanpham = mysqli_query($mysqli,$sql_sua_sanpham);

$query_sanpham = mysqli_query($mysqli, $sql_sua_sanpham);
$rows = mysqli_fetch_array($query_sanpham);

$sql_lay_danhmuc = "SELECT id_danhmuc FROM tbl_sanpham WHERE id_sanpham = $_GET[idsanpham] LIMIT 1";
$query_lay_danhmuc = mysqli_query($mysqli, $sql_lay_danhmuc);
$row_lay_danhmuc = mysqli_fetch_array($query_lay_danhmuc);
$id_danhmuc_sua = $row_lay_danhmuc['id_danhmuc'];

?>

<div style="text-align: center; padding-top:1%">
    <div class="cf-title-02 cf-title-alt-two title_all_sp" style="width:100%; margin-left: 10px;">
        <h2 class="thembaiviet">Sửa sản phẩm <?php echo '<span style="color:blue">' . $rows['tensanpham'] . '</span>' ?></h2>
    </div>
    <hr style="margin-right: 10px;" color="red">
</div>

<div style="padding-bottom: 2%; padding-left: 1%" class="font">
    <a href="<?php echo './index.php?action=quanlysanpham&query=lietkeall' ?>"><i class="fa-solid fa-reply"></i> Trở lại</a>
</div>

<div class="form_them_sp form_them font" style="padding-top:2%; padding-bottom:2%; font-size:20px">
    <form class="row g-3" enctype="multipart/form-data" action="modules/quanlysanpham/xuly.php?idsanpham=<?php echo $_GET['idsanpham'] ?>" method="POST">
        <div class="col-md-5 ten_sp">
            <label for="inputEmail4" class="form-label"><b>Tên sản phẩm</b></label>
            <input type="text" required='true' class="form-control" id="inputEmail4" name="tensanpham" placeholder="Nhập" value="<?php echo $rows['tensanpham'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-5 gia_sp">
            <label for="inputsl" class="form-label"><b>Số lượng sản phẩm</b></label>
            <input type="number" required='true' class="form-control" id="inputsl" name="soluong" placeholder="nhập" value="<?php echo $rows['soluong'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-5 sl_sp">
            <label for="inputPassword4" class="form-label"><b>Giá bán</b></label>
            <input type="number" required='true' class="form-control" id="inputPassword4" name="giasanpham" placeholder="nhập" value="<?php echo $rows['giasanpham'] ?>">
            <hr>
        </div>

        <div class="col-md-5 gia_sp">
            <label for="giamua" class="form-label"><b>Giá mua</b></label>
            <input type="number" required='true' class="form-control" id="giamua" name="giamua" placeholder="nhập" value="<?php echo $rows['giamua'] ?>">
            <hr style="margin-bottom: 5%;">
        </div>


        <div class="col-md-5 sl_sp">
            <label for="inputState" class="form-label"><b>Danh mục</b></label>
            <select id="inputState" class="form-select" name="danhmuc">
                <?php
                $sql_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmucsp = mysqli_query($mysqli, $sql_danhmucsp);
                while ($row_danhmuc = mysqli_fetch_array($query_danhmucsp)) {
                    if ($row_danhmuc['id_danhmuc'] == $rows['id_danhmuc']) {
                ?>
                        <option selected value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <hr>
        </div>

        <div class="col-md-5 gia_sp">
            <label for="noinhap" class="form-label"><b>Nhà cung cấp</b></label>
            <select id="noinhap" class="form-select" name="ncc">
                <?php
                $sql_ncc = "SELECT * FROM tbl_ncc ORDER BY id_ncc DESC";
                $query_ncc = mysqli_query($mysqli, $sql_ncc);
                while ($row_ncc = mysqli_fetch_array($query_ncc)) {
                    if ($row_ncc['id_ncc'] == $rows['id_ncc']) {
                ?>
                        <option selected value="<?php echo $row_ncc['id_ncc'] ?>"><?php echo $row_ncc['tenncc'] ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $row_ncc['id_ncc'] ?>"><?php echo $row_ncc['tenncc']  ?></option>
                <?php
                    }
                }
                ?>
            </select>
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-5 ha_sp">
            <label for="mota" class="form-label"><b>Mô tả</b></label>
            <textarea required='true' class="form-control" id="mota" name="mota" style="font-size: 20px;" rows="7" placeholder="nhập"> <?php echo $rows['mota'] ?> </textarea>
            <hr style="margin-bottom: 5%;">
        </div>


        <div class="col-md-5">
            <label for="image" class="form-label"><b>Hình ảnh</b></label>
            <input class="form-control" id="image_avt" type="file" name="hinhanh">
            <!-- <h4 style="margin-top: 2%;">Sử dụng hình ảnh mới</h4> -->
            <div id="preview_avt" style="margin-top: 2%; margin-left:30%; width:80%"></div>
            <h4>Ảnh cũ</h4>
            <img src="modules/quanlysanpham/uploads/<?php echo $rows['avt'] ?>" style="width:40%">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-12 tdon" style="text-align: center; font-size:20px">
            <button type="submit" class="btn btn-primary" name="suasanpham">Cập nhật</button>
        </div>
    </form>
</div>
<style>

</style>