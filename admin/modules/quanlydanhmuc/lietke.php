<?php
$sql_lietke_danhmucsp = "SELECT * FROM tbl_danhmuc ORDER BY id_danhmuc DESC";
$query_lietke_danhmucsp = mysqli_query($mysqli, $sql_lietke_danhmucsp);

$sql_sanpham = "SELECT COUNT(id_danhmuc) AS dem FROM tbl_danhmuc";
$query_sanpham = mysqli_query($mysqli, $sql_sanpham);
$rows = mysqli_fetch_array($query_sanpham);
$dem  = $rows['dem'];
?>

<head>
    <title>Danh sách danh mục</title>
</head>

<div class="cf-title-02 cf-title-alt-two title_all_sp" style="padding-top: 18px; margin-top:1% ">
    <h2>Danh sách các danh mục (<?php echo $dem ?>)</h2>
</div>
<hr style="margin-left:1%">

<div class="lietke">
    <div class="add_sp font">
        <a href="index.php?action=quanlydanhmuc&query=them">
            <button class="btn btn-primary" style="margin: 0% 0% 1%; padding: 6px 18px; font-size:20px">Thêm danh mục</i></button>
        </a>
    </div>
    <table class="table table-hover table-bordered" style="text-align: center;" border="1">
        <thead class="thead-dark font" style="font-size: 20px;">
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Tên danh mục</th>
                <th>Quản lý</th>
            </tr>
        </thead>
        <tbody class="font" style="font-size: 20px;">
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($query_lietke_danhmucsp)) {
                $i++;
            ?>
                <tr style="border: 1px solid;">
                    <th scope="row"><?php echo $i ?></th>
                    <td><?php echo $row['tendanhmuc'] ?></td>
                    <td class="nut">
                        <!-- sửa -->
                        <a href="?action=quanlydanhmuc&query=sua&iddanhmucsp=<?php echo $row['id_danhmuc'] ?>" style="color: #008FFF;"><i class="fa-solid fa-pen-to-square"></i></a> |
                        <!-- xoá -->
                        <i class="fa-solid fa-trash" onclick="confirmDelete(<?php echo $row['id_danhmuc']; ?>, '<?php echo $row['tendanhmuc'] ?>')"></i>
                    </td>
                </tr>
                <script>
                    function confirmDelete(id, ten) {
                        var result = confirm("Bạn có chắc chắn muốn xoá danh mục " + ten + " không?");
                        if (result) {
                            window.location.href = "modules/quanlydanhmuc/xuly.php?iddanhmucsp=" + id;
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
    .fa-trash {
        color: #7B7C7C;
    }

    .fa-trash:hover {
        color: red;
    }

    .fa-solid {
        padding: 1%;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .fa-solid:hover {
        transform: scale(1.4);
    }
</style>