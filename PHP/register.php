<?php
$conn = new mysqli("MYSQL-8.0.24", "66209010008", "pw66209010008", "66209010008");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("❌ การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = $_POST["email"];

    $stmt = $conn->prepare("INSERT INTO data_user (name, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $pass, $email);

    if ($stmt->execute()) {
        echo "<script>
            alert('✅ สมัครสมาชิกสำเร็จ!\\nไปยังหน้าเข้าสู่ระบบ');
            window.location.href = 'login.php';
        </script>";
    } else {
        echo "<div class='error'>❌ เกิดข้อผิดพลาด: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Register</title>
    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-image: url("https://img.pikbest.com/backgrounds/20220119/science-and-technology-background-earth-particles_6247571.jpg!w700wp");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            margin: 0;
            padding: 0;
            height: 100vh;
        }


        h2 {
            color: white;
            text-align: center;
        }

        form {
            width: 500px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: rgb(116, 159, 251);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* รวม input types ที่คล้ายกัน */
        input[type="text"],
        input[type="password"],
        input[type="email"], /* ควรเปลี่ยน input email เป็น type="email" */
        input[type="tel"] { /* ควรเปลี่ยน input phone เป็น type="tel" */
            width: 95%;
            padding: 8px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color:rgb(81, 133, 245);
            color: white;
            border: none;
            margin-top: 15px;
            padding: 10px;
            width: 100%;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background-color:rgb(7, 176, 255);
        }

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: white; /* เปลี่ยนสีข้อความเป็นสีขาวเพื่อให้เห็นชัดเจนบนพื้นหลังมืด */
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>

    <form method="post" action="">
        <h2>สมัครสมาชิก</h2>
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <input type="submit" value="Register">
    </form>
    <?php
    // แสดงข้อความ error ที่กำหนดไว้ใน PHP
    if (!empty($error_message)) {
        echo "<div class='message error'>" . htmlspecialchars($error_message) . "</div>";
    }
    // แสดงข้อความจาก URL parameters (จาก redirect อื่นๆ ที่ยังคงมีอยู่)
    if (isset($_GET['message']) && isset($_GET['type'])) {
        $message_type = htmlspecialchars($_GET['type']);
        $message_text = htmlspecialchars($_GET['message']);
        echo "<div class='message " . $message_type . "'>" . $message_text . "</div>";
    }
    ?>
</body>
</html>