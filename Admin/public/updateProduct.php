<?php
require_once '../connection/connectData.php';

if(isset($_POST['sbm'])) {
    // Lấy thông tin sản phẩm từ form
    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_type = $_POST['p_type'];

    // Nếu có file hình ảnh được chọn, thực hiện cập nhật
    if($_FILES['p_image']['name']) {
        $p_image = $_FILES['p_image']['name'];
        $p_image_tmp = $_FILES['p_image']['tmp_name'];
        move_uploaded_file($p_image_tmp, '../images/'. $p_image);
        $sql = "UPDATE product SET p_name = '$p_name', p_price = '$p_price', p_type = '$p_type', p_image = '$p_image' WHERE p_id = $p_id";
    } else {
        // Nếu không có file hình ảnh mới, chỉ cập nhật thông tin về tên, giá và loại sản phẩm
        $sql = "UPDATE product SET p_name = '$p_name', p_price = '$p_price', p_type = '$p_type' WHERE p_id = $p_id";
    }

    // Thực thi truy vấn SQL
    if (mysqli_query($conn, $sql)) {
        // Nếu thành công, chuyển hướng người dùng về trang quản lý sản phẩm
        header('Location: manageProduct.php');
        exit(); // Kết thúc script sau khi chuyển hướng để đảm bảo không có mã nào được thực thi tiếp sau khi chuyển hướng
    } else {
        // Nếu có lỗi, hiển thị thông báo lỗi
        echo "Lỗi cập nhật sản phẩm: " . mysqli_error($conn);
    }
} else {
    // Nếu không có biến sbm được gửi, chuyển hướng người dùng về trang quản lý sản phẩm
    header('Location: manageProduct.php');
    exit();
}
?>
