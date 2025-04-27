<?php

if (isset($_POST['doimatkhau'])) {
    $taikhoan = $_POST['email'];
    $matkhau_cu = md5($_POST['password_cu']);
    $matkhau_moi = md5($_POST['password_moi']);
    $nhaplaimk = md5($_POST['nhaplaimatkhau']);
    // $id_dangky = $_POST['id_dangky'];
    $sql = "SELECT * FROM tbl_admin WHERE username ='" . $taikhoan . "' AND password ='" . $matkhau_cu . "' LIMIT 1";
    $row = mysqli_query($mysqli, $sql);
    $count = mysqli_num_rows($row);

    if ($matkhau_moi != $nhaplaimk) {
        echo '<p style="color:red">Mật khẩu nhập lại không đúng.</p>';
    } else {
        if ($count > 0) {
            $sql_sua = mysqli_query($mysqli, "UPDATE tbl_admin SET password = '" . $matkhau_moi . "' ");
            echo '<p style="color:green">Mật khẩu được thay đổi thành công.</p>';
        } else {
            echo '<p style="color:red">Tài khoản hoặc mật khẩu không đúng, vui lòng nhập lại.</p>';
        }
    }
}
?>
<script>
    // phần ẩn và hiển thị mật khẩu
    function togglePassword(fieldId) {
        var field = document.getElementById(fieldId);
        var button = field.nextElementSibling;
        var icon = button.querySelector('i');
        if (field.type === "password") {
            field.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            field.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }
</script>

<head>
    <title>
        ADMIN
    </title>
</head>
<div class="doimk">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2 class="text-center">Đổi mật khẩu của bạn</h2>
        </div>
        <div class="panel-body">
            <form action="" method="POST">

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input required="true" type="email" class="form-control" id="email" placeholder="Nhập email" style="padding: 25px 15px 25px; font-size:18px" name="email">
                </div>

                <div class="form-group">
                    <label for="old_pwd">Mật khẩu cũ:</label>
                    <div class="input-group">
                        <input required="true" type="password" class="form-control" id="old_pwd" placeholder="Nhập mật khẩu" style="padding: 25px 15px 25px; font-size:18px" name="password_cu">
                        <button type="button" class="toggle-password see" onclick="togglePassword('old_pwd')"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="new_pwd">Mật khẩu mới:</label>
                    <div class="input-group">
                        <input required="true" type="password" class="form-control" id="new_pwd" placeholder="Nhập mật khẩu" style="padding: 25px 15px 25px; font-size:18px" name="password_moi">
                        <button type="button" class="toggle-password see" onclick="togglePassword('new_pwd')"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="form-group">
                    <label for="confirmation_pwd">Nhập lại mật khẩu:</label>
                    <div class="input-group">
                        <input required="true" type="password" class="form-control" id="confirmation_pwd" placeholder="Nhập lại mật khẩu" style="padding: 25px 15px 25px; font-size:18px" name="nhaplaimatkhau">
                        <button type="button" class="toggle-password see" onclick="togglePassword('confirmation_pwd')"><i class="fa-solid fa-eye-slash"></i></button>
                    </div>
                </div>
                <div class="nutdoi">
                    <button type="submit" class="btn btn-primary" name="doimatkhau"><b>Đổi mật khẩu</b></button>
                </div>

            </form>
        </div>
    </div>
</div>
<style>
    .form-group {
        margin-bottom: 3%;
    }

    .text-center {
        color: blue
    }

    .btn:hover {
        background-color: #D90000;
        color: white;
    }

    .see {
        border: none;
        background-color: white;
    }

    .nutdoi {
        width: auto;
        /* border: 1px solid; */
        margin-top: 5%;
        height: auto;
        padding: 0 42%;
    }
</style>