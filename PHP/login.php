<?php
// เริ่ม session หากยังไม่เริ่ม
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$conn = new mysqli("MYSQL-8.0.24", "66209010008", "pw66209010008", "66209010008");
if ($conn->connect_error) {
    die("❌ การเชื่อมต่อล้มเหลว: " . $conn->connect_error);
}

$error_message = "";

// เงื่อนไขเมื่อมีการ submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    // ตรวจสอบผู้ใช้ในฐานข้อมูล
    $stmt = $conn->prepare("SELECT id, name, email, password FROM data_user WHERE name = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_pass = $row['password'];

        if (password_verify($password, $hashed_pass)) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            header("Location: Home.php");
            exit();
        } else {
            $error_message = "❌ รหัสผ่านไม่ถูกต้อง";
        }
    } else {
        $error_message = "❌ ไม่พบชื่อผู้ใช้นี้";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon " type="images/it.jpg" href="/PHP/photo/it.jpg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@100;200;300;400;500;600;700&family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Login</title>
    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-image: url("https://t4.ftcdn.net/jpg/04/93/49/37/360_F_493493706_jP0lDchc8vMySihawHZG1RPvLOnJ1iqs.jpg");
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

        input[type="text"],
        input[type="password"] {
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
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h2>Login</h2>
    <form method="post" action="">
        <label>Username or Email:</label>
        <input type="text" name="username" required style="font-family: Kanit, sans-serif"><br>
        <label>Password:</label>
        <input type="password" name="password" required style="font-family: Kanit, sans-serif"><br>
        <a href="register.php" style="color:blue;" aria-valuetext="hee">ไม่มีบัญชีใช่ไหม? Register</a>
        <input type="submit" value="Login" style=" font-family: Kanit, sans-serif";>
    </form>
    <?php
    if (!empty($error_message)) {
        echo "<div class='message error'>" . htmlspecialchars($error_message) . "</div>";
    }
    ?>
</body>
</html>
