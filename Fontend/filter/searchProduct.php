<?php
session_start();
// Kết nối cơ sở dữ liệu
$conn = new mysqli('localhost', 'root', '', 'toy-shop');
$p_name = $_POST['p_name'];

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kiểm tra xem người dùng có nhập từ khóa "deer" không
if ($p_name === "deer") {
    // Thực hiện hành động khi người dùng nhập từ khóa "deer"
    // Ví dụ: hiển thị một tin nhắn thông báo
    $sql = "SELECT * FROM product WHERE p_name = '$p_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div id="' . $row['p_idfake'] . '" class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item toy canbanghinh' . $row['p_id'] .' " >
                <div class="block2">
                    <div class="block2-pic hov-img0 box' . $row['p_id'] .' heeee">
                        <img  src="images/' . $row['p_image'] . '" alt="IMG-PRODUCT">
                        <div>
                            <i id="cart' . $row['p_id'] . '" class="fa-duotone fa-basket-shopping-simple hand-icon icon icon1 cart1" style="--fa-primary-color: #d27014; --fa-secondary-color: #d27014; visibility: hidden;"></i>
                            <i id="love' . $row['p_id'] . '" class="fa-light fa-heart hand-icon icon icon1" style="color: #ea931a; visibility: hidden;"></i>
                            <i id="view' . $row['p_id'] . '" class="fa-solid fa-eye hand-icon icon" style="visibility: hidden;"></i>
                        </div>
                    </div>
                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l">
                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 text">
                                ' . $row['p_name'] . '
                            </a>
                            <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 text1">
                                ' . $row['p_type'] . '
                            </p>
                            <span class="stext-105 cl3 price">
                                ' . $row['p_price'] . '
                            </span>
                        </div>
                        <div class="block2-txt-child2 flex-r p-t-3"></div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "<p>Không tìm thấy sản phẩm.</p>";
    }
} else {
    // Truy vấn dữ liệu từ bảng product
    $sql = "SELECT * FROM product WHERE p_name = '$p_name'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div id="' . $row['p_idfake'] . '" class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item toy canbanghinh' . $row['p_id'] .' " >
                <div class="block2">
                    <div class="block2-pic hov-img0 box' . $row['p_id'] .'">
                        <img  src="images/' . $row['p_image'] . '" alt="IMG-PRODUCT">
                        <div>
                            <i id="cart' . $row['p_id'] . '" class="fa-duotone fa-basket-shopping-simple hand-icon icon icon1 cart1" style="--fa-primary-color: #d27014; --fa-secondary-color: #d27014; visibility: hidden;"></i>
                            <i id="love' . $row['p_id'] . '" class="fa-light fa-heart hand-icon icon icon1" style="color: #ea931a; visibility: hidden;"></i>
                            <i id="view' . $row['p_id'] . '" class="fa-solid fa-eye hand-icon icon" style="visibility: hidden;"></i>
                        </div>
                    </div>
                    <div class="block2-txt flex-w flex-t p-t-14">
                        <div class="block2-txt-child1 flex-col-l">
                            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 text">
                                ' . $row['p_name'] . '
                            </a>
                            <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 text1">
                                ' . $row['p_type'] . '
                            </p>
                            <span class="stext-105 cl3 price">
                                ' . $row['p_price'] . '
                            </span>
                        </div>
                        <div class="block2-txt-child2 flex-r p-t-3"></div>
                    </div>
                </div>
            </div>';
        }
    } else {
        echo "<p>Không tìm thấy sản phẩm.</p>";
    }
}
?>
