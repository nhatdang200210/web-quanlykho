<head>
    <title>Admin - Thêm sản phẩm mới</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Thêm sản phẩm mới</h2>
</div>
<hr style="margin-left: 1%;" color="red">

<a href="index.php?action=quanlysanpham&query=lietkeall">
    <button class="btn btn-success" style="margin: 0% 1% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</button>
</a>

<div class="form_them" style=" padding: 2% 0">
    <div style="font-size: 20px;">
        <form class="row g-3" enctype="multipart/form-data" action="modules/quanlysanpham/xuly.php" method="POST">
            <div class="col-md-5 ten_sp">
                <label for="inputEmail4" class="form-label"><b>Tên sản phẩm</b></label>
                <input type="text" required='true' class="form-control" id="inputEmail4" name="tensanpham" placeholder="Nhập">
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-5 gia_sp">
                <label for="inputsl" class="form-label"><b>Số lượng sản phẩm</b></label>
                <input type="number" required='true' class="form-control" id="inputsl" name="soluong" placeholder="Nhập">
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-5 sl_sp">
                <label for="inputPassword4" class="form-label"><b>Giá bán</b></label>
                <input type="number" required='true' class="form-control" id="inputPassword4" name="giasanpham" placeholder="Nhập">
                <hr>
            </div>

            <div class="col-md-5 gia_sp">
                <label for="giamua" class="form-label"><b>Giá mua</b></label>
                <input type="number" required='true' class="form-control" id="giamua" name="giamua" placeholder="Nhập">
                <hr style="margin-bottom: 5%;">
            </div>


            <div class="col-md-5 sl_sp">
                <label for="inputState" class="form-label"><b>Danh mục</b></label>
                <select id="inputState" class="form-select" name="danhmuc">
                    <?php
                    $sql_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                    $query_danhmucsp = mysqli_query($mysqli, $sql_danhmucsp);
                    while ($row_danhmuc = mysqli_fetch_array($query_danhmucsp)) {
                    ?>
                        <option value="<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></option>
                    <?php
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
                    ?>
                        <option value="<?php echo $row_ncc['id_ncc'] ?>"><?php echo $row_ncc['tenncc'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-md-5 ha_sp">
                <label for="mota" class="form-label"><b>Mô tả</b></label>
                <textarea required='true' class="form-control" id="mota" name="mota" style="font-size: 20px;" rows="4" placeholder="nhập"> </textarea>
                <hr style="margin-bottom: 5%;">
            </div>



            <!-- <div class="col-md-5 ha_sp">
                <label for="inputtt" class="form-label"><b>Trạng thái</b></label>
                <select id="inputtt" class="form-select" name="tinhtrang">
                    <option value="1">Còn</option>
                    <option value="0">Hết</option>
                </select>
                <hr>
            </div> -->

            <div class="col-md-5">
                <label for="image_avt" class="form-label"><b>Hình đại diện</b></label>
                <input required='true' class="form-control" id="image_avt" type="file" name="hinhanh">
                <div id="preview_avt" style="margin-top: 2%; margin-left:30%; width:80%"></div>
                <hr style="margin-bottom: 5%;">
            </div>

            <div class="col-12 tdon" style="text-align: center;">
                <button type="submit" class="btn btn-primary" name="themsanpham" style="font-size: 20px;">Thêm sản phẩm mới</button>
            </div>
        </form>
    </div>
    <style>

    </style>