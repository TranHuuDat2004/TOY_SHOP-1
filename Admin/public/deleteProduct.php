<?php
    require_once '../connection/connectData.php';
    if(isset($_GET['p_id'])) {
        $p_id= $_GET['p_id'];
    }
    $sql = "DELETE FROM product WHERE p_id=$p_id";
    $query = mysqli_query($conn, $sql);
    header('Location: manageProduct.php');
    
?>