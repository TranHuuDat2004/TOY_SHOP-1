<?php
session_start();
// Kiểm tra xem dữ liệu từ biểu mẫu HTML đã được gửi chưa
if(isset($_POST['p_name'])) {
    // Kết nối cơ sở dữ liệu
    $conn = new mysqli('localhost', 'root', '', 'toy-shop');

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $p_name = $_POST['p_name'];

    $sql = "SELECT * FROM product WHERE p_name LIKE '%$p_name%'";
    $result = $conn->query($sql);

    // Kiểm tra xem có sản phẩm nào được tìm thấy không
    if ($result->num_rows > 0) {
        // Lặp qua các hàng kết quả
        while($row = $result->fetch_assoc()) {
            
            $image = $row['p_image'];
            $name = $row['p_name'];
            $type = $row['p_type'];
            $price = $row['p_price'];

            ?>
            <div class=" <?= $name ?> col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item toy">
                <div class="block2">
                    <div class="block2-pic hov-img0" style="border: 0.1px dashed #000; border-radius: 50px;">
                        <img src="images/<?= $image ?>" alt="IMG-PRODUCT">
                    </div>
                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l">
                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6"><?= $name ?></a>
                            <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 text1"><?= $type ?></p>
                            <span class="stext-105 cl3 price">$<?= $price ?></span>
                        </div>
                        <div class="block2-txt-child2 flex-r p-t-3">
                            <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
                                <img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        }
    } else {
        // Hiển thị thông báo nếu không tìm thấy sản phẩm
        echo "Không tìm thấy sản phẩm phù hợp";
    }
    // Đóng kết nối cơ sở dữ liệu
    $conn->close();
} else {
    echo "Vui lòng nhập từ khóa để tìm kiếm sản phẩm.";
}
?>
