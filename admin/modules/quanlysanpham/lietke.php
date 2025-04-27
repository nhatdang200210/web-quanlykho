<head>
    <title>Sản phẩm</title>
</head>
<?php
$sql_lietke_sanpham = "SELECT * FROM tbl_sanpham,tbl_danhmuc, tbl_ncc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_ncc.id_ncc = tbl_sanpham.id_ncc AND tbl_sanpham.giasanpham != 0 
    AND tbl_sanpham.id_danhmuc = '$_GET[id]' ORDER BY id_sanpham DESC";
$query_lietke_sanpham = mysqli_query($mysqli, $sql_lietke_sanpham);

$sql_danhmuc = "SELECT * FROM tbl_danhmuc WHERE id_danhmuc = '$_GET[id]'";
$query_danhmuc = mysqli_query($mysqli, $sql_danhmuc);
$row_danhmuc = mysqli_fetch_array($query_danhmuc);


$sql_sanpham = "SELECT COUNT(id_sanpham) AS dem FROM tbl_sanpham,tbl_danhmuc WHERE tbl_sanpham.id_danhmuc=tbl_danhmuc.id_danhmuc AND tbl_sanpham.id_danhmuc = '$_GET[id]'
 ORDER BY id_sanpham DESC";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem  = $rows['dem'];


$sql_sanpham_moi = "SELECT COUNT(id_sanpham) AS dem FROM tbl_sanpham WHERE giasanpham = 0 
 ORDER BY id_sanpham DESC";
$query_sanpham_moi = mysqli_query($mysqli, $sql_sanpham_moi);
$row_spnhap = mysqli_fetch_array($query_sanpham_moi);
$demspnhap  = $row_spnhap['dem'];
?>

<div style="display: flex; width:100%; margin-top:1%; margin-bottom:1%; margin-left:10px" class="title_all_sp">
    <div class="cf-title-02 cf-title-alt-two ten_csp" style="margin: auto; padding-bottom:5px">
        <h2 class="lkbaiviet">Các sản phẩm trong <?php echo $row_danhmuc['tendanhmuc'] ?> (<?php echo $dem ?> item)</h2>
    </div>
</div>

<div class="table-responsive lk_sp font">
    <!-- lọc theo danh mục -->
    <div style="width:100% ; padding: 1% 0px; display:flex; box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .1), 0 2px 6px 2px rgba(60, 64, 67, .15); border-radius:7px; margin-bottom: 15px">
        <div class="dropdown" style="width :13%; margin-right:1%">
            <a class="btn btn-secondary dropdown-toggle font" href="#" role="button" data-toggle="dropdown" aria-expanded="false" style="width: 100%">
                <h5 style="margin-bottom: 0px;padding:4px">Lọc theo danh mục </h5>
            </a>
            <ul class="dropdown-menu font" aria-labelledby="dropdownMenuLink">
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
                <button class="btn btn-warning" style="font-size: 20px; padding: 7px 19px;">Sản phẩm mới nhập (<?php echo $demspnhap ?>)</button>
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
                <th scope="col" style="width:12%">Trạng thái</th>
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
                        <img src="modules/quanlysanpham/uploads/<?php echo $row['avt'] ?>" width="50%" style="border-radius:20px">
                        <div class="ten_sp">
                            <?php echo $row['tensanpham'] ?>
                        </div>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['tendanhmuc'] ?>
                    </td>

                    <td class="none" style="text-align: center;vertical-align: middle;">
                        <?php echo $row['tenncc'] ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;"><?php echo number_format($row['giasanpham'], 0, ',', '.') . 'vnđ' ?></td>

                    <td style="text-align: center;vertical-align: middle;"><?php echo number_format($row['giamua'], 0, ',', '.') . 'vnđ' ?></td>


                    <td style="text-align: center; vertical-align: middle;">
                        <?php if ($row['tinhtrang'] == 1) {
                        ?>
                            <b style="color:green;background-color: green; padding:4% 18%; margin-top: 10%; border-radius: 10px; color:white">Còn: <b style="font-size: 22px;"><?php echo $row['soluong'] ?> </b> </b>
                        <?php
                        } else {
                            echo '<b style="color:green;background-color: rgb(255, 0, 0); padding:4% 18%; margin-top: 10%; border-radius: 10px; color:white">Hết</b>';
                        }
                        ?>
                    </td>

                    <td style="text-align: center;vertical-align: middle;">
                        <a href="?action=quanlysanpham&query=sua&idsanpham=<?php echo $row['id_sanpham'] ?>">
                            <button class="btn btn-outline-primary btnsp" style="margin-right:2%; padding: 6px 14px;">Sửa</button>
                        </a>
                        <button class="btn btn-outline-danger btnsp" onclick="confirmDelete(<?php echo $row['id_sanpham']; ?>)" style="margin-right:2%; padding: 6px 14px;">Xoá</button>
                        <button class="btn btn-outline-success btnsp detail-btn" data-form-id="<?php echo $id_sanpham ?>">Chi tiết</button>

                        <!-- Form popup tương ứng với từng sản phẩm (ẩn ban đầu) -->
                        <div class="form-popup" id="form-<?php echo $row['id_sanpham']; ?>" style="display: none;">
                            <div class="form-content">
                                <h4 style="margin-bottom: 18px; font-weight:600">Chi tiết sản phẩm <?php echo $row['tensanpham']; ?></h4>
                                <div style=" border-radius:15px">
                                    <div style="display: flex;">
                                        <div style="width: 40%;">
                                            <img src="modules/quanlysanpham/uploads/<?php echo $row['avt'] ?>" width="90%" style="border-radius:20px">
                                        </div>
                                        <div style="width:70%;text-align: justify;">
                                            <p>
                                                <b style="font-size: 24px;">
                                                    <?php echo $row['tensanpham']; ?>
                                                </b>
                                            </p>

                                            <p>
                                                <b> Danh Mục:</b> <?php echo $row['tendanhmuc']; ?>
                                            </p>
                                            <p>
                                                <b> Thương hiệu:</b> <?php echo $row['tenncc']; ?>
                                            </p>
                                            <p>
                                                <b> Tồn kho:</b> <?php echo $row['soluong']; ?>
                                            </p>
                                            <p>
                                                <b> Giá Mua:</b> <?php echo number_format($row['giamua'], 0, ',', '.') . 'vnđ' ?>
                                            </p>
                                            <p>
                                                <b> Giá bán:</b> <?php echo number_format($row['giasanpham'], 0, ',', '.') . 'vnđ' ?>
                                            </p>
                                            <p style="margin-top: 10px;">
                                                <b>Mô tả: <br> </b><?php echo nl2br(htmlspecialchars($row['mota'])); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <button class="cancel btn btn-secondary" data-form-id="<?php echo $row['id_sanpham']; ?>" style="margin-top: 10px; font-size:19px;">Ẩn</button>
                            </div>
                        </div>

                    </td>
                </tr>
                <script>
                    function confirmDelete(id) {
                        var result = confirm("Bạn có chắc chắn muốn xoá sản phẩm \"<?php echo $row['tensanpham'] ?>\" không?");
                        if (result) {
                            window.location.href = "modules/quanlysanpham/xuly.php?idsanpham=" + id;
                        }
                    }

                    // Hiển thị form chi tiết khi nhấn vào nút "Chi tiết"
                    document.querySelectorAll(".detail-btn").forEach(button => {
                        button.addEventListener("click", function(event) {
                            event.preventDefault(); // Ngăn chặn việc tải lại trang

                            var formId = this.getAttribute("data-form-id");
                            var form = document.getElementById("form-" + formId);

                            // Ẩn tất cả các form khác trước khi hiển thị form hiện tại
                            document.querySelectorAll(".form-popup").forEach(popup => {
                                popup.style.display = "none";
                            });

                            if (form.style.display === "none" || form.style.display === "") {
                                form.style.display = "block"; // Hiển thị form
                            } else {
                                form.style.display = "none"; // Ẩn form nếu đã hiển thị
                            }
                        });
                    });

                    // Xử lý nút "Huỷ" để đóng form
                    document.querySelectorAll(".cancel").forEach(button => {
                        button.addEventListener("click", function() {
                            var formId = this.getAttribute("data-form-id");
                            document.getElementById("form-" + formId).style.display = "none"; // Đóng form khi nhấn nút "Huỷ"
                        });
                    });
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

    .form-popup {
        display: none;
        /* Ban đầu ẩn */
        position: fixed;
        top: 45%;
        left: 50%;
        transform: translate(-50%, -50%);
        /* Căn giữa theo cả trục ngang và dọc */
        border: 3px solid #f1f1f1;
        z-index: 9;
        width: 1100px;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        padding: 20px;
        max-height: 90%;
        overflow-y: auto;
    }

    .cancel {
        background-color: blue;
    }

    .cancel:hover {
        opacity: 1;
    }

    p {
        margin-bottom: 0.5rem;
    }
</style>