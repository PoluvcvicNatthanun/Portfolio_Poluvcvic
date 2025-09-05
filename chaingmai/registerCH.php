<?php
$conn = new mysqli("MYSQL-8.0.24", "66209010008", "pw66209010008", "66209010008");

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("❌ การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["username"];
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user_cnx (user, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $pass);

    if ($stmt->execute()) {
        echo "<script>
            alert('✅ สมัครสมาชิกสำเร็จ!\\nไปยังหน้าเข้าสู่ระบบ');
            window.location.href = 'loginCH.php';
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
            background-color: darkblue;
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

        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background-color: white;
            border-radius: 4px;
            height: 50px;
            width: 100%;
            margin-top: 20px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            transition: background-color 0.2s, transform 0.1s;
            }

        .google-btn img {
            height: 30px;
            width: 30px;
            border-radius: 4px;
        }

        .google-btn span {
            font-size: 16px;
            color: #444;
            font-weight: 500;
        }

        .google-btn:hover {
            background-color: #f5f5f5;
            transform: scale(1.02);
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
        <input type="submit" value="Register" class="google-btn">
        
        <div class="google-btn" onclick="window.location.href='google_login.php'">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSua7o13hCS1lopLSoAf5zJA1f69XVh4p7w0A&s" alt="Google">
            <span>Google</span>
        </div>
        <div class="google-btn" onclick="window.location.href='facebook_login.php'">
            <img src="data:image/png;base64,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" alt="Facebook">
            <span>Facebook</span>
        </div>

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