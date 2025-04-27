<?php
$sql_lietke_sanpham = "SELECT * FROM tbl_sanpham, tbl_ncc WHERE tbl_ncc.id_ncc = tbl_sanpham.id_ncc AND giasanpham = 0 ORDER BY id_sanpham DESC";
$query_lietke_sanpham = mysqli_query($mysqli, $sql_lietke_sanpham);




$sql_sanpham = "SELECT COUNT(id_sanpham) AS dem FROM tbl_sanpham WHERE giasanpham = 0
 ORDER BY id_sanpham DESC";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem  = $rows['dem'];
?>

<div style="display: flex; width:100%; margin-top:1%; margin-bottom:1%" class="title_all_sp">
    <div class="cf-title-02 cf-title-alt-two ten_csp" style="margin: auto; padding-bottom:5px">
        <h2 class="lkbaiviet">Các sản phẩm mới nhập hàng (<?php echo $dem ?> item)</h2>
    </div>
</div>

<div class="table-responsive lk_sp font">
    <!-- lọc theo danh mục -->
    <div style="width:100% ; padding: 1% 0px; display:flex; box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15); border-radius:7px; margin-bottom: 15px">
        <div class="dropdown" style="width :13%; margin-right:1%">
            <a class="btn btn-secondary dropdown-toggle font" href="#" role="button" data-toggle="dropdown" aria-expanded="false" style="width: 100%">
                <h5 style="margin-bottom: 0px;padding:4px">Lọc theo danh mục </h5>
            </a>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li>
                    <a class="dropdown-item" style="color: black;" href="index.php?action=quanlysanpham&query=lietkeall">Tất cả sản phẩm</a>
                </li>
                <?php
                $sql_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
                $query_danhmucsp = mysqli_query($mysqli, $sql_danhmucsp);
                while ($row_danhmuc = mysqli_fetch_array($query_danhmucsp)) {
                ?>
                    <li>
                        <a class="dropdown-item" style="color: black;" href="index.php?action=quanlysanpham&query=lietke&id=<?php echo $row_danhmuc['id_danhmuc'] ?>"><?php echo $row_danhmuc['tendanhmuc'] ?></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div>
            <a href="index.php?action=quanlysanpham&query=spnhap">
                <button class="btn btn-warning" style="font-size: 20px; padding: 7px 19px;">Sản phẩm mới nhập (<?php echo $dem ?>)</button>
            </a>
        </div>
    </div>

    <div class="add_sp" style="margin-top: 1%;">
        <a href="index.php?action=quanlysanpham&query=them">
            <button class="btn btn-primary" style="margin: 0% 0% 1%; padding: 6px 18px; font-size:20px">Thêm <i class="fa-solid fa-circle-plus"></i></button>
        </a>
    </div>
    <table class="table table-hover table-bordered">
        <thead class="thead-dark" style="text-align: center; font-size:20px">
            <tr>
                <th scope="col" class="none" style="width:4%">STT</th>
                <th scope="col" style="width:20%">Tên và hình</th>
                <th scope="col" class="none" style="width:10%">Danh mục</th>
                <th scope="col" class="none" style="width:18%">Nhà cung cấp</th>
                <th scope="col" style="width:10%">Giá bán</th>
                <th scope="col" style="width:10%">Giá mua</th>
                <th scope="col" style="width:12%">Số lượng</th>
                <th scope="col">Quản lý</th>
            </tr>
        </thead>
        <tbody style="font-size: 18px;">
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_sanpham)) {
                $id_sanpham = $row['id_sanpham'];
                $i++;

            ?>
                <tr>
                    <?php
                    if ($row['tinhtrang'] == 1 && $row['soluong'] < 5) {
                    ?>
                        <th scope="row" class="none" style="text-align: center;vertical-align: middle; background-color: rgb(255, 153, 0); "><?php echo $i ?></th>
                    <?php
                    } else {
                    ?>
                        <th scope="row" class="none" style="text-align: center;vertical-align: middle; "><?php echo $i ?></th>
                    <?php
                    }

                    ?>
                    <td style="width:20%; text-align:center; vertical-align: middle;">
                        <img src="modules/quanlysanpham/uploads/<?php echo $row['avt'] ?>" width="50%" style="border-radius:20px" alt="Chưa có hình sản phẩm">
                        <div class="ten_sp">
                            <?php echo $row['tensanpham'] ?>
                        </div>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['id_danhmuc'] ?>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['tenncc'] ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle; color:red; font-weight:600"><?php echo number_format($row['giasanpham'], 0, ',', '.') . 'vnđ' ?></td>

                    <td style="text-align: center;vertical-align: middle;"><?php echo number_format($row['giamua'], 0, ',', '.') . 'vnđ' ?></td>


                    <td style="text-align: center; vertical-align: middle;">
                        <?php if ($row['tinhtrang'] == 1) {
                        ?>
                            <b style="color:green;background-color: green; padding:4% 18%; margin-top: 10%; border-radius: 10px; color:white"> <b style="font-size: 22px;"><?php echo $row['soluong'] ?> sản phẩm</b> </b>
                        <?php
                        } else {
                            echo '<b style="color:green;background-color: rgb(255, 0, 0); padding:4% 18%; margin-top: 10%; border-radius: 10px; color:white">Hết</b>';
                        }
                        ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;">
                        <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">
                            <button class="btn btn-outline-primary btnsp" style="margin-right:2%; padding: 6px 14px;">Cập nhật</button>
                        </a>
                        <button class="btn btn-outline-danger btnsp" onclick="confirmDelete(<?php echo $row['id_sanpham']; ?>)" style="margin-right:2%; padding: 6px 14px;">Xoá</button>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id) {
                        var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm \"<?php echo $row['tensanpham'] ?>\" không?");
                        if (result) {
                            window.location.href = "modules/quanlysanpham/xuly.php?idsanpham=" + id;
                        }
                    }
                </script>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<script>
    function confirmDelete(id) {
        var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm không?");
        if (result) {
            window.location.href = "modules/quanlysanpham/xuly.php?idsanpham=" + id;
        }
    }
</script>
<style>
    .lk_sp {
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

    .fa-solid:hover {
        transform: scale(1.4);
    }

    .fa-circle-plus:hover {
        transform: scale(1.2);
    }
</style>