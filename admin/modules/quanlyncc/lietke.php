<?php
$sql_lietke = "SELECT * FROM tbl_ncc ORDER BY id_ncc DESC";
$query_lietke = mysqli_query($mysqli, $sql_lietke);

$sql_sanpham = "SELECT COUNT(id_ncc) AS dem FROM tbl_ncc";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem  = $rows['dem'];
?>

<head>
    <title>Danh sách nhà cung cấp</title>
</head>

<div style="text-align: center; padding-top:0.5%;">
    <div style="display: flex; width:100%">
        <div style="margin-top: 10px; width:100%">
            <h2 class="lkbaiviet">Tổng <?php echo $dem ?> nhà cung cấp</h2>
        </div>
    </div>
    <hr style="" color="red">
</div>


<div class="table-responsive lk_sp">
    <div class="add_sp font">
        <a href="index.php?action=quanlyncc&query=them">
            <button class="btn btn-primary" style="margin: 0% 0% 1%; padding: 6px 18px; font-size:20px">Thêm nhà cung cấp</i></button>
        </a>
    </div>

    <table class="table table-hover table-bordered">
        <thead class="thead-dark font" style="text-align: center; font-size:20px">
            <tr>
                <th scope="col" class="none" style="width:3%">STT</th>
                <th scope="col" style="width:17%">Tên nhà cung cấp</th>
                <th scope="col" class="none" style="width:16%">Email</th>
                <th scope="col" class="none" style="width:13%">Số điện thoại</th>
                <th scope="col" style="width:30%">Địa chỉ</th>
                <th scope="col">Quản lý</th>
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

                    <td style="width:20%; text-align:center; vertical-align: middle;">
                        <div class="ten_sp">
                            <?php echo $row['tenncc'] ?>
                        </div>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['email_ncc'] ?>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        0<?php echo $row['sdt_ncc'] ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;">
                        <?php echo $row['diachi_ncc'] ?>
                    </td>


                    <td style="text-align: center;vertical-align: middle;">
                        <a href="?action=quanlyncc&query=sua&idncc=<?php echo $row['id_ncc'] ?>">
                            <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px;">Sửa</button>
                        </a>
                        <button class="btn btn-danger" onclick="confirmDelete(<?php echo $row['id_ncc']; ?>, '<?php echo $row['tenncc']; ?>')" style="margin-right:2%; padding: 6px 14px;">Xoá</button>
                        <a href="index.php?action=quanlyncc&query=lsu&idncc=<?php echo $row['id_ncc'] ?>">
                            <button class="btn btn-success" style="margin-right:2%; padding: 6px 14px;">Lịch sử giao dịch</button>
                        </a>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id, ten) {
                        var result = confirm('Bạn có chắc chắn muốn xoá nhà cung cấp ' + '"' + ten + '"' + ' phẩm không?');
                        if (result) {
                            window.location.href = "modules/quanlyncc/xuly.php?idncc=" + id;
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