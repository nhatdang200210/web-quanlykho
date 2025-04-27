<head>
    <title>Admin</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Thêm khách hàng mới</h2>
</div>
<hr style="margin-left: 1%;">

<a href="index.php?action=quanlytaikhoan&query=lietke">
    <button class="btn btn-success font" style="margin: 0% 1%; padding: 6px 18px; font-size:20px">Xem danh sách</button>
</a>

<div class="form_them font" style="margin-top: 1%; padding: 2% 25%; font-size:20px">
    <form class="row g-3" enctype="multipart/form-data" action="modules/quanlytaikhoan/xuly.php" method="POST">
        <div class="col-md-10 ten_sp">
            <label for="inputEmail4" class="form-label"><b>Tên khách hàng</b></label>
            <input type="text" required='true' class="form-control" id="inputEmail4" name="tenkhachhang" placeholder="Nhập">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="inputPassword4" class="form-label"><b>Số điện thoại</b></label>
            <input type="number" maxlength="10" required='true' class="form-control" id="inputPassword4" name="sdt" placeholder="nhập">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="noinhap" class="form-label"><b>Email</b></label>
            <input type="email" required='true' class="form-control" id="noinhap" name="email" placeholder="nhập">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-md-10 ten_sp">
            <label for="dc" class="form-label"><b>Địa chỉ</b></label>
            <input type="text" required='true' class="form-control" id="dc" name="diachi" placeholder="nhập">
            <hr style="margin-bottom: 5%;">
        </div>

        <div class="col-12 tdon" style="width: 15%; margin:auto">
            <button type="submit" class="btn btn-primary" name="themkhachhang" style="padding: 5px 18px; font-size:19px;">Thêm</button>
        </div>
    </form>
</div>
<style>

</style>