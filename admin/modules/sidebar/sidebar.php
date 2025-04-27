<?php
if (isset($_GET['dangxuat']) && $_GET['dangxuat'] == 1) {
    unset($_SESSION['dangnhap']);
    header('Location:login.php');
    exit();
}
?>

<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="font" style="font-size:20px">
        <div class="sidebar-header" style="display: flex; flex-wrap: nowrap;">
            <!-- <img src="https://play-lh.googleusercontent.com/hverPDLh_cVTN4QsYzc0-Nlgvx5e4EyoSYgVZt5VUj96jv5uiGZatkVnBwIQczdB2U0" alt="" style="width:25%; border-top-left-radius: 12px"> -->
            <div style="width:100%; margin:auto; margin-left: 3%">
                <h2 style="text-align: center; margin-bottom:0; font-weight:600">QUẢN LÝ KHO</h2>
            </div>
        </div>

        <ul class="list-unstyled components">
            <hr>
            <?php
            $id = $_SESSION['id'];
            $sql_kt = "SELECT * FROM tbl_admin WHERE id_admin = '$id' ";
            $query_kt = mysqli_query($mysqli, $sql_kt);
            $kt = mysqli_fetch_array($query_kt);
            if ($kt['admin_status'] == 0) {
            ?>
                <li>
                    <a href="#ncc" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"><i class="fa-brands fa-shopify"></i> Nhà cung cấp</a>
                    <!-- <a href="#ncc" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a <?php echo $current_action == 'quanlyncc' ? 'menu-selected' : ''; ?>">
                        <i class="fa-brands fa-shopify"></i> Nhà cung cấp
                    </a> -->
                    <ul class="collapse list-unstyled" id="ncc">
                        <li style="border-bottom:1px solid white">
                            <a href="index.php?action=quanlyncc&query=them"><i class="fa-solid fa-circle-plus"></i> Thêm nhà cung cấp</a>
                        </li>
                        <li class="bot">
                            <a href="index.php?action=quanlyncc&query=lietke"><i class="fa-solid fa-list"></i> Danh sách</a>
                        </li>

                    </ul>
                </li>
                <hr>
                <li>
                    <a href="#danhmuc" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"><i class="fa-regular fa-bookmark"></i> Danh mục sản phẩm</a>
                    <ul class="collapse list-unstyled" id="danhmuc" style="">
                        <!-- <li>
                            <a href="index.php?action=quanlydanhmuc&query=lietke"> <i class="fa-solid fa-clipboard"></i> Danh sách</a>
                        </li> -->
                        <li style="border-bottom:1px solid white">
                            <a href="index.php?action=quanlydanhmuc&query=them"><i class="fa-solid fa-circle-plus"></i> Thêm danh mục</a>
                        </li>
                        <li class="bot">
                            <a href="index.php?action=quanlydanhmuc&query=lietke"><i class="fa-solid fa-list"></i> Danh sách</a>
                        </li>
                    </ul>
                </li>
                <hr>

            <?php
            }
            ?>
            <li>
                <a href="#hh" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"><i class="fa-solid fa-headphones-simple"></i> Sản phẩm</a>
                <ul class="collapse list-unstyled" id="hh">
                    <li style="border-bottom:1px solid white">
                        <a href="index.php?action=quanlysanpham&query=them"><i class="fa-solid fa-circle-plus"></i> Thêm sản phẩm</a>
                    </li>
                    <li class="bot">
                        <a href="index.php?action=quanlysanpham&query=lietkeall"><i class="fa-solid fa-list"></i> Danh sách</a>
                    </li>

                </ul>
            </li>
            <hr>
            <li>
                <a href="#kh" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"> <i class="fa-solid fa-user"></i> Khách hàng</a>
                <ul class="collapse list-unstyled" id="kh">
                    <li class="bot">
                        <a href="index.php?action=quanlytaikhoan&query=them"><i class="fa-solid fa-pen-to-square"></i> Thêm khách hàng</a>
                    </li>
                    <li>
                        <a href="index.php?action=quanlytaikhoan&query=lietke"><i class="fa-solid fa-newspaper"></i> Danh sách </a>
                    </li>

                </ul>
            </li>
            <hr>
            <li>
                <a href="#nhap" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"> <i class="fa-solid fa-pen-nib"></i> Nhập hàng hoá</a>
                <ul class="collapse list-unstyled" id="nhap">
                    <li class="bot">
                        <a href="index.php?action=quanlynhap&query=them"><i class="fa-solid fa-pen-to-square"></i> Tạo đơn </a>
                    </li>
                    <li>
                        <a href="index.php?action=quanlynhap&query=danhsach"><i class="fa-solid fa-newspaper"></i> Danh sách đơn </a>
                    </li>

                </ul>
            </li>
            <hr>
            <li>
                <a href="#xuat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"> <i class="fa-solid fa-truck-fast"></i> Xuất hàng hoá</a>
                <ul class="collapse list-unstyled" id="xuat">
                    <li class="bot">
                        <a href="index.php?action=quanlyxuat&query=them"><i class="fa-solid fa-pen-to-square"></i> Tạo đơn</a>
                    </li>
                    <li>
                        <a href="index.php?action=quanlyxuat&query=danhsach"><i class="fa-solid fa-newspaper"></i> Danh sách </a>
                    </li>

                </ul>
            </li>
            <hr>

            <?php
            $id = $_SESSION['id'];
            $sql_kt = "SELECT * FROM tbl_admin WHERE id_admin = '$id' ";
            $query_kt = mysqli_query($mysqli, $sql_kt);
            $kt = mysqli_fetch_array($query_kt);
            if ($kt['admin_status'] == 0) {
            ?>
                <li>
                    <a href="#nv" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle a"> <i class="fa-solid fa-person"></i> Nhân viên</a>
                    <ul class="collapse list-unstyled" id="nv">
                        <li class="bot">
                            <a href="index.php?action=quanlynv&query=them"><i class="fa-solid fa-pen-to-square"></i> Thêm nhân viên</a>
                        </li>
                        <li>
                            <a href="index.php?action=quanlynv&query=lietke"><i class="fa-solid fa-newspaper"></i> Danh sách </a>
                        </li>

                    </ul>
                </li>
                <hr>
                <li>
                    <a href="index.php?action=quanlythongke&query=thongke" class="dropdown-item a" id="thongke"><i class="fa-solid fa-layer-group"></i> Thống kê</a>
                </li>
            <?php
            }
            ?>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content" class="font">
        <?php
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM tbl_admin WHERE id_admin = '$id' ";
        $query = mysqli_query($mysqli, $sql);
        $ad = mysqli_fetch_array($query);
        ?>
        <nav class="navbar navbar-expand-lg navbar-light " style="margin-bottom:0.5%; background-color:rgb(230, 230, 230)">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn" style="background-color: chocolate; color: white">
                    <i class="fa-solid fa-bars"></i>
                    <span>Quản lý</span>
                </button>
            </div>
            <div class="dropdown" style="width :10%">
                <a href="#" role="button" data-toggle="dropdown" aria-expanded="false" style="display: flex;">
                    <i class="fa fa-user" style="font-size: 33px; color:chocolate"></i>
                    <div style="padding: 4px 6px; color:chocolate">
                        <b style="font-size:20px"><?php echo $ad['tennv'] ?></b>
                    </div>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li>
                        <a class="dropdown-item" style="color: black;" href="index.php?action=doimatkhau&query=doi">Đổi mật khẩu</a>
                    </li>
                    <li>
                        <a class="dropdown-item" style="color: black;" href="index.php?dangxuat=1">Đăng xuất</a>
                    </li>

                </ul>
            </div>
        </nav>


        <div class="quanly">
            <?php
            if (isset($_GET['action']) && $_GET['query']) {
                $tam = $_GET['action'];
                $query = $_GET['query'];
            } else {
                $tam = '';
                $query = '';
            }
            //thêm danh mục
            if ($tam == 'quanlydanhmuc' && $query == 'them') {
                include 'modules/quanlydanhmuc/them.php';
            }
            //liêyj kê danh mục
            elseif ($tam == 'quanlydanhmuc' && $query == 'lietke') {
                include 'modules/quanlydanhmuc/lietke.php';
            }
            // sửa danh mục
            elseif ($tam == 'quanlydanhmuc' && $query == 'sua') {
                include 'modules/quanlydanhmuc/sua.php';
            }
            //thêm nhà cung cấp
            elseif ($tam == 'quanlyncc' && $query == 'them') {
                include 'modules/quanlyncc/them.php';
            }
            // liệt kê nhà cung cấp
            elseif ($tam == 'quanlyncc' && $query == 'lietke') {
                include 'modules/quanlyncc/lietke.php';
            }
            // sửa nhà cung cấp
            elseif ($tam == 'quanlyncc' && $query == 'sua') {
                include 'modules/quanlyncc/sua.php';
            }
            // ls giao dịch nhà cung cấp
            elseif ($tam == 'quanlyncc' && $query == 'lsu') {
                include 'modules/quanlyncc/lsu.php';
            }
            //Thêm sản phẩm
            elseif ($tam == 'quanlysanpham' && $query == 'them') {
                include 'modules/quanlysanpham/them.php';
            }
            //Sửa sản phẩm
            elseif ($tam == 'quanlysanpham' && $query == 'sua') {
                include 'modules/quanlysanpham/sua.php';
            }
            //Chi tiết sản phẩm
            elseif ($tam == 'quanlysanpham' && $query == 'chitiet') {
                include 'modules/quanlysanpham/chitiet.php';
            }
            //Liệt kê sản phẩm theo danh mục
            elseif ($tam == 'quanlysanpham' && $query == 'lietke') {
                include 'modules/quanlysanpham/lietke.php';
            }
            //Liệt kê all sản phẩm
            elseif ($tam == 'quanlysanpham' && $query == 'lietkeall') {
                include 'modules/quanlysanpham/allsp.php';
            }
            //Liệt kê all sản phẩm nhập
            elseif ($tam == 'quanlysanpham' && $query == 'spnhap') {
                include 'modules/quanlysanpham/spnhap.php';
            }
            //tạo đơn nhập hàng
            elseif ($tam == 'quanlynhap' && $query == 'them') {
                include 'modules/quanlynhap/them.php';
            }
            // danh sách đơn nhập
            elseif ($tam == 'quanlynhap' && $query == 'danhsach') {
                include 'modules/quanlynhap/danhsach.php';
            }
            // chi tiết đơn nhập
            elseif ($tam == 'quanlynhap' && $query == 'chitiet') {
                include 'modules/quanlynhap/chitiet.php';
            }
            // in đơn nhập
            elseif ($tam == 'quanlynhap' && $query == 'indon') {
                include 'modules/quanlynhap/indon.php';
            }
            //tạo đơn xuất hàng
            elseif ($tam == 'quanlyxuat' && $query == 'them') {
                include 'modules/quanlyxuat/them.php';
            }
            // danh sách xuất hàng
            elseif ($tam == 'quanlyxuat' && $query == 'danhsach') {
                include 'modules/quanlyxuat/danhsach.php';
            }
            // chi tiết xuất hàng
            elseif ($tam == 'quanlyxuat' && $query == 'chitiet') {
                include 'modules/quanlyxuat/chitiet.php';
            }
            //Liệt kê all tài khoản
            elseif ($tam == 'quanlytaikhoan' && $query == 'lietke') {
                include 'modules/quanlytaikhoan/danhsach.php';
            }
            //Thêm khách hàng
            elseif ($tam == 'quanlytaikhoan' && $query == 'them') {
                include 'modules/quanlytaikhoan/them.php';
            }
            //sửa khách hàng
            elseif ($tam == 'quanlytaikhoan' && $query == 'sua') {
                include 'modules/quanlytaikhoan/sua.php';
            }
            //đổi mật khẩu
            elseif ($tam == 'doimatkhau' && $query == 'doi') {
                include 'doimatkhau.php';
            }
            //đăng xuất
            elseif ($tam == 'dangxuat' && $query == 'dangxuat') {
                include 'dangxuat.php';
            }
            // danh sách nhân viên
            elseif ($tam == 'quanlynv' && $query == 'lietke') {
                include 'modules/quanlynv/lietke.php';
            }
            // thêm nhân viên
            elseif ($tam == 'quanlynv' && $query == 'them') {
                include 'modules/quanlynv/them.php';
            }
            // sửa nhân viên
            elseif ($tam == 'quanlynv' && $query == 'sua') {
                include 'modules/quanlynv/sua.php';
            }
            // thống kê
            elseif ($tam == 'quanlythongke' && $query == 'thongke') {
                include 'modules/quanlythongke/thongke.php';
            } else {
                include 'modules/quanlysanpham/allsp.php';
            }


            ?>
        </div>
    </div>
</div>

<style>
    ul#homeSubmenu li a,
    ul#pageSubmenu li a,
    ul#danhmucSubmenu li a {
        /* color: red; */
        font-weight: 600;
    }

    ul#homeSubmenu,
    ul#danhmucSubmenu,
    ul#pageSubmenu {
        font-size: 17px;
        font-style: inherit;
    }

    *:hover a {
        text-decoration: none;
    }

    .dropdown-toggle,
    mn {
        color: white;
    }

    .dropdown-item {
        color: white
    }

    .fa-bars,
    .fa-headphones-simple,
    .fa-pen-nib,
    .fa-cart-plus,
    .fa-user,
    .fa-pen-to-square,
    .fa-newspaper,
    .fa-circle-plus,
    .fa-clipboard,
    .fa-chart-simple {
        font-size: 22px;
        padding-right: 6px;
    }

    .bot {
        border-bottom: 1px solid white;
    }

    .menu-selected {
        background-color: rgba(237, 223, 192, 0.793);
        color: rgb(8, 8, 8) !important;
        transform: scale(1.03);
        border-radius: 10px;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Lấy các tham số action và query từ URL
        const urlParams = new URLSearchParams(window.location.search);
        const action = urlParams.get('action');
        const query = urlParams.get('query');

        // Danh sách các mục cần kiểm tra
        const menuItems = [{
                action: 'quanlyncc',
                query: 'them',
                elementId: 'ncc'
            },
            {
                action: 'quanlyncc',
                query: 'lietke',
                elementId: 'ncc'
            },
            {
                action: 'quanlyncc',
                query: 'sua',
                elementId: 'ncc'
            },
            {
                action: 'quanlydanhmuc',
                query: 'them',
                elementId: 'danhmuc'
            },
            {
                action: 'quanlydanhmuc',
                query: 'sua',
                elementId: 'danhmuc'
            },
            {
                action: 'quanlydanhmuc',
                query: 'lietke',
                elementId: 'danhmuc'
            },
            {
                action: 'quanlysanpham',
                query: 'them',
                elementId: 'hh'
            },
            {
                action: 'quanlysanpham',
                query: 'lietkeall',
                elementId: 'hh'
            },
            {
                action: 'quanlysanpham',
                query: 'lietke',
                elementId: 'hh'
            },
            {
                action: 'quanlysanpham',
                query: 'spnhap',
                elementId: 'hh'
            },
            {
                action: 'quanlysanpham',
                query: 'sua',
                elementId: 'hh'
            },
            {
                action: 'quanlytaikhoan',
                query: 'them',
                elementId: 'kh'
            },
            {
                action: 'quanlytaikhoan',
                query: 'lietke',
                elementId: 'kh'
            },
            {
                action: 'quanlytaikhoan',
                query: 'sua',
                elementId: 'kh'
            },
            {
                action: 'quanlynhap',
                query: 'them',
                elementId: 'nhap'
            },
            {
                action: 'quanlynhap',
                query: 'danhsach',
                elementId: 'nhap'
            },
            {
                action: 'quanlynhap',
                query: 'chitiet',
                elementId: 'nhap'
            },
            {
                action: 'quanlyxuat',
                query: 'them',
                elementId: 'xuat'
            },
            {
                action: 'quanlyxuat',
                query: 'danhsach',
                elementId: 'xuat'
            },
            {
                action: 'quanlyxuat',
                query: 'chitiet',
                elementId: 'xuat'
            },
            {
                action: 'quanlynv',
                query: 'them',
                elementId: 'nv'
            },
            {
                action: 'quanlynv',
                query: 'lietke',
                elementId: 'nv'
            },
            {
                action: 'quanlynv',
                query: 'sua',
                elementId: 'nv'
            },
            {
                action: 'quanlythongke',
                query: 'thongke',
                // id: 'thongke'
            }
        ];

        // Duyệt qua các mục để tô màu
        menuItems.forEach(item => {
            if (item.action === action && item.query === query) {
                document.querySelector(`a[href="#${item.elementId}"]`).classList.add('menu-selected');
            }
        });
    });
</script>