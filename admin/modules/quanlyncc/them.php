<head>
    <title>Thêm nhà cung cấp</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Thêm nhà cung cấp mới</h2>
</div>
<hr style="margin-left: 1%;" color="red">

<a href="index.php?action=quanlyncc&query=lietke">
    <button class="btn btn-success" style="margin: 0% 1% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</button>
</a>

<div class="form_them" style=" padding: 2% 0">
    <div style=" width: 43%; margin: auto; font-size:20px">
        <form class="row g-3" enctype="multipart/form-data" action="modules/quanlyncc/xuly.php" method="POST">
            <div class="col-md-12">
                <label for="inputEmail4" class="form-label"><b>Tên nhà cung cấp</b></label>
                <input type="text" required='true' class="form-control" id="inputEmail4" name="tenncc" placeholder="Nhập">
                <hr style=" margin-bottom: 5%;">
            </div>

            <div class=" col-md-12">
                <label for="email" class="form-label"><b>Email</b></label>
                <input type="text" required='true' class="form-control" id="email" name="email" placeholder="nhập">
                <hr>
            </div>

            <div class="col-md-12">
                <label for="dt" class="form-label"><b>Điện thoại</b></label>
                <input type="number" required='true' class="form-control" id="dt" name="sdt" placeholder="nhập">
                <hr>
            </div>


            <div class="col-md-12">
                <label for="dc" class="form-label"><b>Địa chỉ</b></label>
                <input type="text" required='true' class="form-control" id="dc" name="diachi" placeholder="nhập">
                <hr>
            </div>

            <div class="col-12 tdon" style="text-align: center;">
                <button type="submit" class="btn btn-primary" name="themncc" style="font-size: 20px;">Thêm nhà cung cấp</button>
            </div>
        </form>
    </div>
</div>
<style>
    input {
        font-size: 19px !important;
    }
</style>