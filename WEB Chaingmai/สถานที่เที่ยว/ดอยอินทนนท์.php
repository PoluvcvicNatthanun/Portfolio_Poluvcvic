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
    <title>ดอยอินทนนท์</title>
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
        footer { background-color:#68b9eb; text-align: center; padding: 20px;}
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
        <h1 class="title">ดอยอินทนนท์</h1>
        
        <div class="images">
            <img src="https://image-tc.galaxy.tf/wijpeg-sxrfid5inslt46adwg0pwpho/intanon_standard.jpg?crop=112%2C0%2C1777%2C1333">
            <img src="https://s.isanook.com/tr/0/ud/282/1412729/4-3_1.jpg?ip/crop/w670h402/q80/jpg">
            <img src="https://www.khaosod.co.th/wpapp/uploads/2023/11/IMG_1572.jpeg">
        </div>

        <div class="description">
            <p>
                <strong>ดอยอินทนนท์</strong> เป็นยอดเขาที่สูงที่สุดในประเทศไทย ตั้งอยู่ในอุทยานแห่งชาติดอยอินทนนท์ จังหวัดเชียงใหม่
                มีความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้อากาศเย็นตลอดทั้งปีและบางครั้งมีน้ำค้างแข็งในฤดูหนาว
                บนดอยมีสถานที่น่าสนใจมากมาย เช่น พระมหาธาตุนภเมทนีดลและพระมหาธาตุนภพลภูมิสิริ,
                เส้นทางศึกษาธรรมชาติกิ่วแม่ปาน และน้ำตกสวยงามหลายแห่ง
            </p>
            <p>
                นอกจากธรรมชาติที่งดงามแล้ว ดอยอินทนนท์ยังมีวัฒนธรรมท้องถิ่นของชาวม้งและกะเหรี่ยง
                นักท่องเที่ยวสามารถเพลิดเพลินกับอาหารพื้นบ้าน ชมไร่สตรอว์เบอร์รี และเลือกซื้อสินค้าพื้นเมืองได้ตลอดทางขึ้นดอย
            </p>
            <button style="font-family: 'Kanit', sans-serif; " color="white" type="submit"><a href="https://maps.app.goo.gl/GoqQTrsmwui7kqBE9" target="_blank" rel="noopener" style="text-decoration: none; color:white">Map</a></button>
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
        <strong>ช่องทางการติดต่อ </strong><br>
        <p>Gmail : nut647864@gmail.com</p>
        <a href="https://www.facebook.com/poluvucvic" target="_blank" >https://www.facebook.com/poluvucvic</a>
        <a href="https://www.instagram.com/poluvcvic/" target="_blank">https://www.instagram.com/poluvcvic/</a>
    </footer>
</body>
</html>
