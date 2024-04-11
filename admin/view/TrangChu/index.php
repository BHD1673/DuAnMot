<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
</div>

<!-- Content Row -->
<div class="row">
    <?php

    $sql = "SELECT 
    YEAR(orders.tao_vao_luc) AS Nam,
    MONTH(orders.tao_vao_luc) AS Thang,
    SUM(order_items.item_total_price) AS TongThuNhap
FROM
    orders
        INNER JOIN
    order_items ON orders.order_id = order_items.order_id
WHERE
    orders.trang_thai NOT IN ('Mới nhận đơn hàng', 'Huỷ đơn')
GROUP BY YEAR(orders.tao_vao_luc), MONTH(orders.tao_vao_luc)
ORDER BY Nam DESC, Thang DESC;


    ";

    $monthValue = pdo_query($sql);


    ?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo "Tổng thu nhập của tháng " . $monthValue[0]['Thang'] . " năm " . $monthValue[0]['Nam'] . "" ?></div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $monthValue[0]['TongThuNhap'] ?>0 VNĐ</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Tổng số lượng sản phẩm</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php
                            $sql = "SELECT SUM(so_luong) AS tong_so_luong_san_pham
                            FROM san_pham_bien_the;
                            ";

                            $pendingValue = pdo_query($sql);

                            echo $pendingValue[0]['tong_so_luong_san_pham'];
                            ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số lượng đơn hàng chưa xử lý</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php

                            $sql = "SELECT COUNT(*) AS so_luong_don_hang_moi
                            FROM orders
                            WHERE trang_thai = 'Mới nhận đơn hàng';
                            ";

                            $pendingValue = pdo_query($sql);

                            echo $pendingValue[0]['so_luong_don_hang_moi'];
                            ?>

                        </div>
                    </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Số lượng đơn hàng bị huỷ</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php

                            $sql = "SELECT COUNT(*) AS so_luong_don_hang_huy
                            FROM orders
                            WHERE trang_thai = 'Huỷ đơn';                            
                            ";

                            $pendingValue = pdo_query($sql);

                            echo $pendingValue[0]['so_luong_don_hang_huy'];
                            ?>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-signal fa-2x text-gray-300" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->

<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Doanh số trong năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">
                    <?php require_once "admin/view/ThongKe/DoanhSo/DoanhSoBanRa.php"; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Area Chart -->
    <div class="col-xl-4 col-lg-3">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Doanh số trong năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-area">

                    <?php
                    $sql = "SELECT 
                            danh_muc.ten_danh_muc AS TenDanhMuc,
                            COUNT(san_pham.id) AS SoLuongSanPham
                            FROM 
                            danh_muc
                            LEFT JOIN 
                            san_pham ON danh_muc.id = san_pham.id_danh_muc
                            GROUP BY 
                            danh_muc.id;
                            ";

                    $itemCount = pdo_query($sql);

                    $chartData = [];

                    foreach ($itemCount as $item) {
                        $chartData[] = [
                            'label' => $item['TenDanhMuc'],
                            'value' => $item['SoLuongSanPham']
                        ];
                    }

                    ?>


                    <canvas id="myChart" width="400" height="400"></canvas>
                    <script>
                        var data = <?php echo json_encode($chartData); ?>;

                        var labels = data.map(function(item) {
                            return item.label;
                        });

                        var values = data.map(function(item) {
                            return item.value;
                        });

                        var ctx = document.getElementById('myChart').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: labels,
                                datasets: [{
                                    data: values,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.5)',
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(255, 206, 86, 0.5)',
                                        'rgba(75, 192, 192, 0.5)'
                                    ]
                                }]
                            },
                            options: {
                                title: {
                                    display: true,
                                    text: 'Product Categories'
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>