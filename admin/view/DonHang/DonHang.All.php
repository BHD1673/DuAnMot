<div class="container">
        <h2>Orders Table</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Tổng giá trị đơn hàng</th>
                    <th>Phương thức thanh toán</th>
                    <th>Ngày tạo</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "thithu";

                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM orders";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["order_id"] . "</td>";
                            echo "<td>" . $row["total_price"] . "</td>";
                            echo "<td>" . $row["payment_method"] . "</td>";
                            echo "<td>" . $row["created_at"] . "</td>";
                            echo '<td>            <a href="#" class="btn btn-primary">Xem chi tiết đơn hàng</a>
                            <a href="#" class="btn btn-secondary">Xoá đơn hàng</a>
                            <a href="#" class="btn btn-secondary">Cập nhật đơn hàng đơn hàng</a>
                            </td>
                            ';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No results found</td></tr>";
                    }
                    $conn->close();
                ?>
            </tbody>
        </table>
    </div>