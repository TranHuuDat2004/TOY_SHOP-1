<?php
if(isset($_GET['productID'])) {
    $productID = $_GET['productID'];
    
    $sql = "INSERT INTO wishlist (toyName, imageProducts, price)
            SELECT toyName, imageProducts, price FROM products
            WHERE NOT EXISTS (
                SELECT 1 FROM wishlist WHERE wishlist.toyName = products.toyName
            ) AND products.productID = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productID);
    
    if ($stmt->execute()) {
        header('Location: ../freshshop/index.php');
        exit();
    } else {
        echo "Lỗi: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();

?>