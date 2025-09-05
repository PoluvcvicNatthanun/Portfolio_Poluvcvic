<?php
session_start();
if (!isset($_POST['product_name']) || !isset($_POST['price'])) {
    header("Location: Home.php");
    exit();
}

$product_name = htmlspecialchars($_POST['product_name']);
$price = htmlspecialchars($_POST['price']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ยืนยันการสั่งซื้อ</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; text-align: center; padding: 50px; background-color: #f8f8f8; }
        .box { background: white; padding: 40px; display: inline-block; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        button { padding: 10px 20px; font-size: 18px; border: none; background-color: #4caf50; color: white; border-radius: 6px; cursor: pointer; }
        button:hover { background-color: #43a047; }
    </style>
</head>
<body>
    <div class="box">
        <h2>ยืนยันการสั่งซื้อ</h2>
        <p>สินค้า: <strong><?= $product_name ?></strong></p>
        <p>ราคา: <strong><?= $price ?> บาท</strong></p>
        <form method="POST" action="backend.php">
            <input type="hidden" name="product_name" value="<?= $product_name ?>">
            <input type="hidden" name="price" value="<?= $price ?>">
            <button type="submit">ยืนยันการซื้อ</button>
        </form>
        <br>
        <a href="Home.php">⬅️ กลับหน้าหลัก</a>
    </div>
</body>
</html>
