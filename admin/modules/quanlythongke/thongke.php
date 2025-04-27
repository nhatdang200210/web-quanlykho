<?php

// Mặc định ngày là ngày hiện tại nếu không có ngày nào được chọn
$selected_date = isset($_POST['selected_date']) ? $_POST['selected_date'] : date('Y-m-d');

// Lấy ngày đầu tiên và cuối cùng trong tuần của ngày được chọn
$first_day_of_week = date('Y-m-d', strtotime('monday this week', strtotime($selected_date)));
$last_day_of_week = date('Y-m-d', strtotime('sunday this week', strtotime($selected_date)));

// Truy vấn lấy dữ liệu số lượng sản phẩm nhập theo tuần
$sql_nhap = "SELECT DATE(tbl_nhap.thoigian) AS order_date, SUM(tbl_cartdetail_nhap.soluong) AS total_nhap, SUM(tbl_cartdetail_nhap.soluong * tbl_cartdetail_nhap.gianhap) AS total_money_nhap 
             FROM tbl_nhap
             JOIN tbl_cartdetail_nhap ON tbl_nhap.id_nhap = tbl_cartdetail_nhap.id_nhap 
             WHERE DATE(tbl_nhap.thoigian) BETWEEN '$first_day_of_week' AND '$last_day_of_week'
             GROUP BY DATE(tbl_nhap.thoigian)";

$result_nhap = mysqli_query($mysqli, $sql_nhap);

// Truy vấn lấy dữ liệu số lượng sản phẩm xuất theo tuần
$sql_xuat = "SELECT DATE(tbl_xuat.ngayxuat) AS order_date, SUM(tbl_cartdetail_xuat.soluong_xuat) AS total_xuat, SUM(tbl_cartdetail_xuat.soluong_xuat * tbl_sanpham.giasanpham) AS total_money_xuat 
             FROM tbl_xuat
             JOIN tbl_cartdetail_xuat ON tbl_xuat.id_xuat = tbl_cartdetail_xuat.id_xuat 
             JOIN tbl_sanpham ON tbl_cartdetail_xuat.id_sanpham = tbl_sanpham.id_sanpham
             WHERE DATE(tbl_xuat.ngayxuat) BETWEEN '$first_day_of_week' AND '$last_day_of_week'
             GROUP BY DATE(tbl_xuat.ngayxuat)";

$result_xuat = mysqli_query($mysqli, $sql_xuat);

// Khởi tạo mảng lưu trữ dữ liệu theo ngày trong tuần
$week_data = array_fill(0, 7, ['order_date' => '', 'total_nhap' => 0, 'total_xuat' => 0, 'total_money_nhap' => 0, 'total_money_xuat' => 0]);

// Lấy dữ liệu nhập vào mảng $week_data
while ($row = mysqli_fetch_array($result_nhap)) {
    $order_date = date('N', strtotime($row['order_date'])) - 1; // Chuyển đổi ngày thành số từ 0 (thứ 2) đến 6 (Chủ Nhật)
    $week_data[$order_date]['order_date'] = $row['order_date'];
    $week_data[$order_date]['total_nhap'] = $row['total_nhap'];
    // $order_date = date('N', strtotime($row['order_date'])) - 1; 
    $week_data[$order_date]['total_money_nhap'] = $row['total_money_nhap'];
}

// Lấy dữ liệu xuất vào mảng $week_data
while ($row = mysqli_fetch_array($result_xuat)) {
    $order_date = date('N', strtotime($row['order_date'])) - 1;
    $week_data[$order_date]['order_date'] = $row['order_date']; //số sp
    $week_data[$order_date]['total_xuat'] = $row['total_xuat']; //đơn
    $week_data[$order_date]['total_money_xuat'] = $row['total_money_xuat']; // tiền bán
}

// Tính tổng số đơn hàng nhập và xuất trong tuần
$total_orders_nhap = 0;
$total_orders_xuat = 0;
// Đếm số đơn nhập và xuất trong tuần
foreach ($week_data as $data) {
    if ($data['total_nhap'] > 0) {
        $total_orders_nhap += 1; // Nếu có hàng nhập, tăng đếm đơn nhập
    }
    if ($data['total_xuat'] > 0) {
        $total_orders_xuat += 1; // Nếu có hàng xuất, tăng đếm đơn xuất
    }
}
//tính tổng doanh thu đã bán trong tuần
$total_money_nhap = 0;
$total_doanh_thu = 0;
foreach ($week_data as $data) {
    $total_doanh_thu += $data['total_money_xuat']; // Tính tổng doanh thu
    $total_money_nhap += $data['total_money_nhap'];
}
// Tính tổng số sản phẩm nhập và xuất trong tuần
$total_products_nhap = 0;
$total_products_xuat = 0;
foreach ($week_data as $data) {
    $total_products_nhap += $data['total_nhap']; // Cộng dồn số sản phẩm nhập
    $total_products_xuat += $data['total_xuat']; // Cộng dồn số sản phẩm xuất
}

// Đóng kết nối cơ sở dữ liệu
mysqli_close($mysqli);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Thống kê xuất nhập trong tuần</title>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container-fluid" style="margin-top:30px">
        <div>
            <div class="nk-content-inner">
                <div class="nk-content-body" style="padding-left: 2%;">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content cf-title-02 cf-title-alt-two " style="margin-left: 0;">
                                <h2 style="text-align: center;">Thống kê xuất nhập trong tuần</h2>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <!-- Form để chọn ngày -->
                    <form method="POST" class="mb-3">
                        <div class="form-group">
                            <label for="selected_date" style="font-weight: bold;">Chọn ngày:</label>
                            <input style="width:150px;" type="date" id="selected_date" name="selected_date" value="<?php echo $selected_date; ?>" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>
                    <div class="row">
                        <div class="col-md-5" style="padding: 20px 0; margin:auto">
                            <canvas id="myChart3"></canvas>
                        </div>
                        <div class="col-md-5" style="padding: 20px 0; margin:auto">
                            <canvas id="myChart4"></canvas>
                        </div>
                        <div class="col-md-9" style="padding: 20px 0; margin:auto">
                            <h2 style="text-align: center;">Thống kê bảng tổng trong tuần</h2>
                            <hr>
                            <table class="table table-bordered" style="width:100%;font-size:20px; ">
                                <tbody>
                                    <tr>
                                        <th scope="row">Tổng đơn xuất hàng trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_orders_xuat)) {
                                                echo $total_orders_xuat;
                                            } else {
                                                echo "0";
                                            }
                                            ?> đơn
                                        </td>
                                        <th scope="row">Tổng đơn nhập hàng trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_orders_nhap)) {
                                                echo $total_orders_nhap;
                                            } else {
                                                echo "0";
                                            }
                                            ?> đơn
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Tổng sản phẩm xuất bán trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_products_xuat)) {
                                                echo $total_products_xuat;
                                            } else {
                                                echo "0";
                                            }
                                            ?> sản phẩm
                                        </td>
                                        <th scope="row">Tổng sản phẩm nhập trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_products_nhap)) {
                                                echo $total_products_nhap;
                                            } else {
                                                echo "0";
                                            }
                                            ?> sản phẩm
                                        </td>
                                    </tr>
                                    <tr>

                                        <th scope="row">Tổng doanh thu trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_doanh_thu)) {
                                                echo number_format($total_doanh_thu, 0, ',', '.');
                                            } else {
                                                echo "0";
                                            }
                                            ?> vnđ
                                        </td>
                                        <th scope="row">Tổng tiền nhập hàng trong tuần:</th>
                                        <td>
                                            <?php
                                            if (isset($total_money_nhap)) {
                                                echo number_format($total_money_nhap, 0, ',', '.');
                                            } else {
                                                echo "0";
                                            }
                                            ?> vnđ
                                        </td>

                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Định nghĩa một hàm để vẽ biểu đồ đường
        function drawChart() {
            var weekData = <?php echo json_encode($week_data); ?>;

            // Lấy các ngày từ weekData
            var labels = weekData.map(data => data.order_date || '');

            var ctx = document.getElementById('myChart3').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line', // biểu đồ đường
                data: {
                    labels: labels, // Hiển thị ngày thay vì thứ
                    datasets: [{
                            label: 'Số lượng SP nhập',
                            data: weekData.map(data => data.total_nhap),
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            fill: false,
                            // lineTension: 0.1
                        },
                        {
                            label: 'Số lượng SP xuất',
                            data: weekData.map(data => data.total_xuat),
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            fill: false,
                            // lineTension: 0.1
                        },
                        {
                            label: 'Số đơn nhập',
                            data: weekData.map(data => (data.total_nhap > 0) ? 1 : 0), // Đếm số đơn nhập
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            fill: false,
                            // lineTension: 0.1,
                            // borderDash: [10, 5] // Đường nét cho số đơn nhập
                        },
                        {
                            label: 'Số đơn xuất',
                            data: weekData.map(data => (data.total_xuat > 0) ? 1 : 0), // Đếm số đơn xuất
                            borderColor: 'rgba(255, 159, 64, 1)',
                            backgroundColor: 'rgba(255, 159, 64, 0.2)',
                            fill: false,
                            // lineTension: 0.1,
                            // borderDash: [10, 5] // Đường nét cho số đơn xuất
                        },

                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    elements: {
                        point: {
                            radius: 6 // Điều chỉnh kích thước điểm trên biểu đồ đường
                        }
                    }
                }
            });

            // Vẽ biểu đồ tổng tiền
            var ctx2 = document.getElementById('myChart4').getContext('2d');
            var myChart2 = new Chart(ctx2, {
                type: 'bar', // Biểu đồ cột
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Tổng tiền nhập',
                            data: weekData.map(data => data.total_money_nhap || 0),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        },
                        {
                            label: 'Tổng tiền xuất (bán)',
                            data: weekData.map(data => data.total_money_xuat || 0),
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                        }
                    ]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            });
        }

        // Gọi hàm vẽ biểu đồ sau khi trang đã tải hoàn toàn
        window.onload = drawChart;
    </script>