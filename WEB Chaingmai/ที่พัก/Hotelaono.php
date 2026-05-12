<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// จัดการบันทึกคอมเมนต์
$commentsFile = "comments.txt";
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['comment']) && trim($_POST['comment']) !== "") {
    $comment = htmlspecialchars($_POST['comment']);
    $username = $_SESSION['username'];
    $date = date("d/m/Y H:i");
    file_put_contents($commentsFile, "$username|$date|$comment\n", FILE_APPEND);
}

// อ่านคอมเมนต์
$comments = [];
if (file_exists($commentsFile)) {
    $lines = file($commentsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        list($user, $time, $text) = explode("|", $line);
        $comments[] = ["user" => $user, "time" => $time, "text" => $text];
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>Hotel Aono</title>
    <link rel="icon" type="image/jpg" href="/Filezilla/images/it.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #eef6f9; margin: 0; padding: 0; }
        .bar1 { background-color: #7ecefc; height: 80px; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; 
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2); }
        .menu a { margin: 0 50px; text-decoration: none; color: black; transition: 0.3s; }
        .menu a:hover { color: white; background-color: #458efb; padding: 5px 10px; border-radius: 5px; }
        .container { max-width: 1000px; margin: auto; padding: 20px; }
        h1.title { text-align: center; margin-top: 20px; color: #2b4c7e; }
        .images { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin: 20px 0; }
        .images img { width: 300px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0,0,0,0.2); }
        .description { background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); line-height: 1.8; }
        .comment-section { margin-top: 30px; background: white; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); }
        .comment-box { display: flex; flex-direction: column; gap: 10px; }
        .comment-box textarea { resize: none; padding: 10px; border-radius: 5px; border: 1px solid #ccc; }
        .comment-box button { background-color: #68b9eb; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; }
        .comment-box button:hover { background-color: #43a0d6; }
        .comment { padding: 10px; border-bottom: 1px solid #ddd; }
        .comment strong { color: #2b4c7e; }
        .description button { margin-top: 10px; padding: 10px 15px; background-color: #68b9eb; color: white; border: none;  border-radius: 6px; cursor: pointer; }
        .description button:hover { background-color: #43a0d6; }
        footer{ background-color: #68b9eb; text-align: center; padding: 20px; display: flex; 
        justify-content: center; align-items: flex-start;}
        footer .center{ text-align: center;}
        .footer-title{ width: 100%; text-align: center; margin-bottom: 10px;}
        .footer-center{ text-align: center; }
        .contact-item{ margin-top: 15px; display: flex; gap: 10px;}
        .contact-item a{ text-decoration: none; color: black;}
        .contact-item a:hover{color: white;}

    </style>
</head>
<body>
    <div class="bar1">
        <h2>สถานที่ท่องเที่ยวเชียงใหม่ 🗺️🌈</h2>
        <div class="menu">
            <a href="homeCH.php">สถานที่เที่ยว</a>
            <a href="#">ที่พัก</a>
            <a href="#">ติดต่อ</a>
            <a href="#">เกี่ยวกับเรา</a>
        </div>
        <div class="menu"><a href="logout.php" style="color:black;">ล็อคเอ้าท์</a></div>
    </div>

    <div class="container">
        <h1 class="title">Hotel Aono</h1>
        
        <div class="images">
            <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/264935884.jpg?k=03a067dd8c67c4658990465fc5ea4aaa62c623290d6c93a944d53db0197ae227&o=">
            <img src="https://images.trvl-media.com/lodging/48000000/47040000/47036000/47035950/157cb42d.jpg?impolicy=resizecrop&rw=575&rh=575&ra=fill">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR4cUkCPJ0uAZGS9eDix-C8lMYGofNlHbhMLg&s">
        </div>

        <div class="description">
            <p>
                <strong>Hotel Aono</strong><br> เป็นโรงแรมเล็กๆ สไตล์มินิมอล ตั้งอยู่ใจกลางเมืองเชียงใหม่ เดินทางสะดวก จะเที่ยวที่ไหนก็ง่าย การตกแต่งของที่นี่คือเรียบง่ายแต่น่ารักสุดๆ ใช้โทนสีขาวคลีนๆ 
                    ตัดกับขอบประตูหน้าต่างลายไม้ ให้ฟีลญี่ปุ่นเบาๆ มินิมอลกำลังดี เฟอร์นิเจอร์ก็เป็นโทนขาวกับไม้ ดูอบอุ่น สบายตา
            </p>
            <button style="font-family: 'Kanit', sans-serif; " color="white" type="submit"><a href="https://maps.app.goo.gl/2LXdHCoeAquYgn5u9" target="_blank" rel="noopener" style="text-decoration: none; color:white">Map</a></button>
        </div>

        <div class="comment-section">
            <h3>💬 แสดงความคิดเห็น</h3>
            <form method="post" class="comment-box">
                <textarea style="font-family: 'Kanit', sans-serif;" name="comment" rows="3" placeholder="พิมพ์ความคิดเห็นของคุณ..." required></textarea>
                <button style="font-family: 'Kanit', sans-serif;" type="submit">ส่งความคิดเห็น</button>
            </form>

            <h3>📌 ความคิดเห็นล่าสุด</h3>
            <?php if (empty($comments)) : ?>
                <p>ยังไม่มีความคิดเห็น</p>
            <?php else: ?>
                <?php foreach (array_reverse($comments) as $c) : ?>
                    <div class="comment">
                        <strong><?= $c['user']; ?></strong> <small>(<?= $c['time']; ?>)</small><br>
                        <?= nl2br($c['text']); ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <footer>
    <div class="footer-center">
        <div class="footer-title">
            <strong>@2025 สถานที่ท่องเที่ยวเชียงใหม่</strong>
        </div>
        <strong>: ช่องทางการติดต่อ :</strong>
        <div class="contact-item">
            <strong>E-mail : </strong>
            <span> nut647864@gmail.com </span>
        </div>
        <div class="contact-item">
            <strong>Facebook : </strong>
            <a href="https://www.facebook.com/poluvucvic" target="_blank">
                 poluvucvic
            </a>
        </div>
        <div class="contact-item">
            <strong>Instagram : </strong>
            <a href="https://www.instagram.com/poluvucvic" target="_blank">
                 poluvucvic
            </a>
        </div>
    </div>
    </footer>
</body>
</html>
