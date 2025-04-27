<head>
    <title>DAnh sách khách hàng</title>
</head>
<?php
$sql_kh = "SELECT COUNT(id_khachhang) AS dem FROM tbl_khachhang";
$query_kh = mysqli_query($mysqli, $sql_kh);
$rows = mysqli_fetch_array($query_kh);
$dem = $rows['dem'];
?>
<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px;">
    <h2>Danh sách khách hàng (<?php echo $dem ?>)</h2>
</div>
<hr style="margin-left: 1%;">
<?php
$sql = "SELECT * FROM tbl_khachhang ORDER BY id_khachhang DESC";
$query = mysqli_query($mysqli, $sql);
?>

<a href="index.php?action=quanlytaikhoan&query=them">
    <button class="btn btn-primary font" style="margin: 0% 1% 0; padding: 6px 18px; font-size:20px">Thêm</button>
</a>
<div class="form_them font" style="width:99%; margin-left:10px; margin-top: 1%; padding: 2% 5%; font-size:20px">
    <table class="table table-hover table-bordered" style="padding: 20px; margin: auto">
        <thead class="thead-dark" style="">
            <tr>
                <th scope="col" style="width:4%; text-align:center">ID</th>
                <th scope="col" style="width:18%">Tên khách hàng</th>
                <th scope="col" style="width:15%">Điện thoại</th>
                <th scope="col" style="width:20%">Email</th>
                <th scope="col" style="width:28%">Địa chỉ</th>
                <th scope="col" style="width:15%; text-align:center"></th>
            </tr>
        </thead>
        <tbody style="border:1px solid; ">
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query)) {
                $i++;
            ?>
                <tr>
                    <td style="padding: 15px; font-size:18px; text-align:center">
                        <?php echo $i ?>
                    </td>

                    <td style="padding: 15px; font-size:18px">
                        <?php echo $row['tenkhachhang'] ?>
                    </td>
                    <td style="padding: 15px; font-size:18px">
                        0<?php echo $row['sdt'] ?>
                    </td>
                    <td style="padding: 15px; font-size:18px">
                        <?php echo $row['email'] ?>
                    </td>
                    <td style="padding: 15px; font-size:18px">
                        <?php echo $row['diachi'] ?>
                    </td>
                    <td style="text-align: center;vertical-align: middle;">
                        <a href="?action=quanlytaikhoan&query=sua&idkhachhang=<?php echo $row['id_khachhang'] ?>">
                            <button class="btn btn-primary" style="margin-right:2%; padding: 6px 14px">Sửa</button>
                        </a>
                        <button class="btn btn-danger" style="margin-right:2%; padding: 6px 14px" onclick="confirmDelete(<?php echo $row['id_khachhang']; ?>)">Xoá</button>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id) {
                        var result = confirm("Bạn có chắc chắn muốn xoá khách hàng không?");
                        if (result) {
                            window.location.href = "modules/quanlytaikhoan/xuly.php?idkhachhang=" + id;
                        }
                    }
                </script>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>