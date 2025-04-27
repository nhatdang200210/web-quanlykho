<?php
$sql_lietke = "SELECT * FROM tbl_admin WHERE admin_status = 1 ORDER BY id_admin DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);

$sql_sanpham = "SELECT COUNT(id_admin) AS dem FROM tbl_admin WHERE admin_status = 1 ";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem  = $rows['dem'];
?>

<head>
    <title>Danh sách nhân viên</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Danh sách nhân viên vận kho (<?php echo $dem ?>)</h2>
</div>
<hr style="margin-left: 1%;">

<div class="table-responsive lk_sp">

    <div class="add_sp font">
        <a href="index.php?action=quanlynv&query=them">
            <button class="btn btn-primary" style="margin: 0% 0% 1%; padding: 6px 18px; font-size:20px">Thêm nhân viên</button>
        </a>
    </div>

    <table class="table table-hover table-bordered" style="width:100%">
        <thead class="thead-dark font" style="text-align: center; font-size:20px">
            <tr>
                <th scope="col" style="width:2%">STT</th>
                <th scope="col" style="width:15%">Tên nhân viên</th>
                <th scope="col" style="width:10%">Mã nhân viên</th>
                <th scope="col" style="width:33%">Địa chỉ</th>
                <th scope="col" style="width:12%">Số điện thoại</th>
                <th scope="col" style="width:14%">Email</th>
                <!-- <th scope="col" style="width:12%">Mật khẩu</th> -->
                <th scope="col" style=""></th>
            </tr>
        </thead>
        <tbody style="font-size: 20px;" class="font">
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke)) {
                $i++;
            ?>
                <tr>
                    <th scope="row" class="none" style="text-align: center;vertical-align: middle;"><?php echo $i ?></th>

                    <td style=" text-align:center; vertical-align: middle;">
                        <div class="ten_sp">
                            <?php echo $row['tennv'] ?>
                        </div>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['manv'] ?>
                    </td>

                    <td class="none" style="vertical-align: middle;">
                        <?php echo $row['diachi'] ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;">
                        0<?php echo $row['sdt'] ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;">
                        <?php echo $row['username'] ?>
                    </td>

                    <!-- <td style="text-align: center;vertical-align: middle;">
                        <?php echo $row['password'] ?>
                    </td> -->

                    <td style="text-align: center;vertical-align: middle;">
                        <a href="?action=quanlynv&query=sua&idnv=<?php echo $row['id_admin'] ?>" style="padding: 0;">
                            <button class="btn btn-primary" style=" padding: 6px 14px;">Sửa</button>
                        </a>
                        <button class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id_admin']; ?>, '<?php echo $row['tennv']; ?>')" style="margin-right:2%; padding: 6px 14px;">Xoá</button>
                    </td>

                </tr>
                <script>
                    function confirmDelete(id, ten) {
                        var result = confirm("Bạn có chắc chắn muốn xoá nhân viên " + ten + " không?");
                        if (result) {
                            window.location.href = "modules/quanlynv/xuly.php?idnv=" + id;
                        }
                    }
                </script>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<style>
    .lk_sp {
        /* background-color: blue; */
        margin-left: 0.5%;
    }

    .fa-trash {
        color: #7B7C7C;
    }

    .fa-trash:hover {
        color: red;
    }

    .fa-solid {
        padding: 1%;
        font-size: 25px;
        transition: all 0.3s ease;
    }

    .fa-trash:hover,
    .fa-pen-to-square:hover {
        transform: scale(1.4);
    }
</style>