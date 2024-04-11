<?php
$sql = "SELECT 
YEAR(ngay_tao) AS year,
MONTH(ngay_tao) AS month,
COUNT(id) AS total_sold
FROM 
san_pham
WHERE 
ngay_tao >= DATE_SUB(CURDATE(), INTERVAL 6 MONTH)
GROUP BY 
YEAR(ngay_tao), MONTH(ngay_tao)
ORDER BY 
year ASC, month ASC";

try {
$salesData = pdo_query($sql);
} catch (PDOException $e) {
echo "Error: " . $e->getMessage();
}

$salesDataJSON = json_encode($salesData);

?>

<canvas id="productSalesChart" width="500" height="300"></canvas>

<script>
    // Retrieve the sales data from PHP and convert it to JavaScript object
    var salesData = <?php echo $salesDataJSON; ?>;

    // Extracting labels (X-axis values) and data (Y-axis values) from the salesData
    var labels = salesData.map(function(item) {
        return item.month + '/' + item.year;
    });

    var data = salesData.map(function(item) {
        return item.total_sold;
    });

    // Creating a line chart
    var ctx = document.getElementById('productSalesChart').getContext('2d');
    var productSalesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Số lượng sản phẩm đã bán ra',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)', // Area fill color
                borderColor: 'rgba(54, 162, 235, 1)', // Line color
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            aspectRatio: 2, // Adjust this value to control the width
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Số lượng sản phẩm đã bán ra'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tháng'
                    }
                }
            }
        }
    });
</script>
