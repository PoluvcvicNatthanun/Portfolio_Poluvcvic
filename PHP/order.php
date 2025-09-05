<?php
session_start();
$conn = new mysqli("MYSQL-8.0.24", "66209010008", "pw66209010008", "66209010008");

if ($conn->connect_error) {
    die("การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['orderData'])) {
    $orderData = json_decode($_POST['orderData'], true);

    if (!is_array($orderData)) {
        die("❌ ข้อมูลคำสั่งซื้อไม่ถูกต้อง");
    }

    $username = $_SESSION['username'] ?? 'guest';
    $total = 0;

    foreach ($orderData as $item) {
        if (!isset($item['price']) || !isset($item['quantity'])) continue;
        $total += $item['price'] * $item['quantity'];
    }

    // บันทึกลงฐานข้อมูล
    $stmtOrder = $conn->prepare("INSERT INTO orders (username, total_price) VALUES (?, ?)");
    $stmtOrder->bind_param("sd", $username, $total);
    $stmtOrder->execute();
    $order_id = $stmtOrder->insert_id;
    $stmtOrder->close();

    $stmtItem = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($orderData as $name => $item) {
        $stmtItem->bind_param("isid", $order_id, $name, $item['quantity'], $item['price']);
        $stmtItem->execute();
    }
    $stmtItem->close();
    $conn->close();
?>
<!-- ส่วนแสดงผล -->
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สรุปคำสั่งซื้อ</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f0f2f5; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .summary-container { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 500px; text-align: center; }
        ul { list-style: none; padding: 0; text-align: left; }
        li { padding: 10px; border-bottom: 1px solid #ddd; }
        a { margin-top: 20px; background-color: #2196f3; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; display: inline-block; }
    </style>
</head>
<body>
    <div class="summary-container">
        <h2>✅ คำสั่งซื้อสำเร็จ</h2>
        <p>👤 ผู้ใช้: <strong><?php echo $_SESSION['username']; ?></strong></p>
        <ul>
            <?php foreach ($orderData as $name => $item): 
                $lineTotal = $item['price'] * $item['quantity']; ?>
                <li><?= htmlspecialchars($name) ?> - <?= $item['price'] ?> x <?= $item['quantity'] ?> = <?= $lineTotal ?> บาท</li>
            <?php endforeach; ?>
        </ul>
        <h3>รวมทั้งหมด: <?= number_format($total, 2) ?> บาท</h3>
        <a href="Home.php">⬅️ กลับหน้าร้าน</a>
    </div>
</body>
</html>

<?php
} else {
    header("Location: home.php");
    exit();
}
?>
