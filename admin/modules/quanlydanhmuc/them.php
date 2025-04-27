<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px; margin-top:1%; margin-bottom:1%;">
    <h2>Thêm danh mục mới</h2>
</div>

<head>
    <title>Thêm danh mục</title>
</head>
<hr style="margin-left:1%">
<div class="add_sp font" style="margin-left:10px">
    <a href="index.php?action=quanlydanhmuc&query=lietke">
        <button class="btn btn-success" style="margin: 0% 0% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</i></button>
    </a>
</div>
<div class="form_them ">

    <form method="POST" action="modules/quanlydanhmuc/xuly.php">
        <div style="display: flex; width:38%; margin:auto; padding-top:1%">
            <div class="form-group font" style=" width:80%">
                <label for="formGroupExampleInput" class="form-label font" style="font-size: 20px;"><b>Thêm danh mục mới</b></label>
                <input required="true" type="text" name="tendanhmuc" class="form-control" id="formGroupExampleInput" placeholder="Nhập">
            </div>
            <div class="nut_them tdon font">
                <label for="formGroupExampleInput" class="form-label" style="font-size: 19px; color:white">T</label>
                <input class="nut" type="submit" name="themdanhmuc" value="Thêm">
                <!-- <button type="submit" class="btn btn-primary" name="themdanhmuc" style="padding: 6px 18px; font-size:18px">Thêm</button> -->
            </div>
        </div>
    </form>
</div>