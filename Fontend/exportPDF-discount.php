<?php
include 'login.php';
include('../Admin/connection/connectionpro.php');
require_once '../Admin/connection/connectData.php';

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (!isset($_SESSION["user"])) {
    header("Location: login.html");
    exit(); // Dừng thực thi tiếp của script
}

// Lấy thông tin người dùng từ session
$userName = $_SESSION["user"];
$sqlLogin = "SELECT * FROM `login` WHERE userName = '$userName' ";
$queryLogin = mysqli_query($conn, $sqlLogin);
$row = $queryLogin->fetch_assoc();
$userLogin = array(
    "userID" => $row["userID"],
    "userName" => $row["userName"],
    "email" => $row["email"],
);

// Truy vấn thông tin đơn hàng
$sqlOrder = "SELECT 
    `order`.o_id, 
    `order`.u_id, 
    `order`.p_id, 
    `order`.o_price, 
    `order`.o_status, 
    `order`.o_quantity,
    product.p_type, 
    product.p_image, 
    product.p_name, 
    product.p_price 
FROM 
    `order`
INNER JOIN 
    product ON `order`.p_id = product.p_id";

$resultOrder = $conn->query($sqlOrder);
$order_array = array();

if ($resultOrder->num_rows > 0) {
    while ($row = $resultOrder->fetch_assoc()) {
        if ($row['u_id'] == $userLogin['userID']) {
            $order_array[] = array(
                "o_id" => $row["o_id"],
                "u_id" => $row["u_id"],
                "p_id" => $row["p_id"],
                "o_price" => $row["o_price"],
                "o_quantity" => $row["o_quantity"],
                "o_status" => $row["o_status"],
                "p_type" => $row["p_type"],
                "p_image" => $row["p_image"],
                "p_name" => $row["p_name"],
                "p_price" => $row["p_price"]
            );
        }
    }
}

// Hàm tính tổng giá tiền
function sumTotalPrice($order_array, $u_id)
{
    $totalPrice = 0;
    foreach ($order_array as $item) {
        if ($item["u_id"] == $u_id && $item["o_status"] == 0) {
            $productPrice = $item["p_price"] * $item["o_quantity"];
            $totalPrice += $productPrice;
        }
    }
    return $totalPrice;
}

// Gọi hàm để tính tổng giá tiền
$totalPrice = sumTotalPrice($order_array, $userLogin["userID"]);

// Truy vấn thông tin chiết khấu dựa trên tên discount (d_name)
$sqlDiscount = "SELECT * FROM discount";
$query = mysqli_query($conn, $sqlDiscount);

// Mảng chứa thông tin chiết khấu
$discount = array();

// Kiểm tra kết quả truy vấn
if ($query->num_rows > 0) {
    // Lặp qua từng hàng dữ liệu từ kết quả truy vấn
    while ($row = $query->fetch_assoc()) {
        // Thêm thông tin từng hàng vào mảng $discount
        $discount = array(
            "d_id" => $row["d_id"],
            "d_name" => $row["d_name"],
            "d_amount" => $row["d_amount"],
            "d_description" => $row["d_description"],
            "d_start_date" => $row["d_start_date"],
            "d_end_date" => $row["d_end_date"]
        );
    }
} else {
    // Nếu không tìm thấy kết quả
    // echo "0 results";
}

// Truy vấn để đếm số dòng trong bảng order
$sql = "SELECT COUNT(*) AS total_rows FROM `order` WHERE u_id = '{$userLogin['userID']}' AND o_quantity > 0 AND o_status = 0";
$result = $conn->query($sql);

// Kiểm tra và hiển thị kết quả
if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$order_count = $row["total_rows"];
} else {
	// echo "Không có dữ liệu trong bảng order";
}

// Lấy ngày hiện tại
$currentDate = date("Y-m-d");

$i = 0;

// Tạo HTML cho tiêu đề và thông tin người mua
$html = '
<!-- Tiêu đề hóa đơn -->
<h2 style="text-align: center;">Invoice</h2>
<p style="text-align: center;">Name Shop : Omacha</p>
<p style="text-align: center;">Employee: Nguyen Thuy Khanh </p>
<p style="text-align: center;">Customer: ' . $userLogin["userName"] . '</p>
<p style="text-align: center;">Date: ' . $currentDate . '</p>

<hr>

<!-- Shoping Cart -->

<table style="text-align:center; width:100%">
    <tr>
        <th class="column-1">Quantity of Items</th>    
        <th class="column-2">Product Name</th>                              
        <th class="column-3">Price</th>
        <th class="column-4">Quantity</th>
        <th class="column-5">Total</th>
    </tr>';

foreach ($order_array as $item) {
    if ($item['u_id'] == $userLogin['userID'] && $item["o_quantity"] > 0 && $item["o_status"] == 0) {
        
        $html .= '<tr>
            <td class="column-1">' . ++$i . '</td>
            <td class="column-2">' . $item["p_name"] . '</td>
            <td class="column-3"> $' . $item["p_price"] . '</td>                                                  
            <td class="column-4">' . $item["o_quantity"] . '</td>                 
            <td class="column-5"> $' . $item["p_price"] * $item["o_quantity"] . '</td>
        </tr> ';
                    
    }
}

// .= có nghĩa là nối chuỗi 
$html .= '</table> 
<hr>
<p style="text-align: center;">Total Quantity of Items: ' . $order_count. '</p>';

$html .= '<p style="text-align:center;"> Subtotal: $' . $totalPrice . '</p>';

$html .= '<p style="text-align:center;"> Discount: ' . $discount["d_amount"] . '%</p>';

$html .= '<p style="text-align:center;"> Saving: $' . $totalPrice * $discount["d_amount"] /100 . '</p>';

$html .= '<p style="text-align:center;"> Shipping: FreeShip ' . '</p>';

$html .= '<p style="text-align:center;"> Total: $' . $totalPrice * ((100 - $discount["d_amount"]) /100) . '</p>';


// Import thư viện Dompdf
require_once('./dompdf/autoload.inc.php');

use Dompdf\Dompdf;

// Khởi tạo đối tượng Dompdf
$domPDF = new Dompdf();

// Load HTML vào Dompdf
$domPDF->loadHtml($html);

// Cài đặt các tùy chọn cần thiết
$domPDF->setPaper('A4', 'portrait');

// Render PDF
$domPDF->render();

// Xuất PDF ra trình duyệt hoặc lưu vào file
$domPDF->stream('invoice.pdf');
