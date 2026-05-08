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
    <title>สวนพฤกษศาสตร์</title>
    <link rel="icon" type="image/jpg" href="/Filezilla/images/it.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #eef6f9; margin: 0; padding: 0; }
        .bar1 { background-color: #7ecefc; height: 80px; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; 
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2); }
        .menu a { margin: 0 10px; text-decoration: none; color: black; transition: 0.3s; }
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
        <h1 class="title">สวนพฤกษศาสตร์</h1>
        
        <div class="images">
            <img src="data:image/jpeg;base64,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">
            <img src="https://chillpainai.com/storage/scoop/cover/2016-06-01-14-29-49-02.jpg">
            <img src="https://tatdataapi.io/dmc-images/1351ee7d-351e-4743-83c4-6e3d3067b798.jpeg">
        </div>

        <div class="description">
            <p>
                <strong>สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์</strong> สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์ สวนสวยๆ ที่ตั้งอยู่ใน ตำบลแม่แรม อำเภอแม่ริม จังหวัดเชียงใหม่ 
                มีพื้นที่กว่า 3,500 ไร่ เป็นสถานที่ที่รวบรวมและอนุรักษ์พรรณไม้ต่างๆ เอาไว้ โดยการปลูกให้สอดคล้องกับธรรมชาติมากที่สุด 
                ซึ่งมีทั้งกลุ่มอาคารเรือนกระจกบนยอดเขา ที่มีความสวยงาม รวมไปถึงมีความรู้อัดแน่นอยู่มากมาย ทำให้สวนนี้ เป็นอีกสถานที่ท่องเที่ยวพักผ่อน และสถานที่ศึกษาธรรมชาตินั่นเอง
            </p>
            <p>
                
            </p>
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
</body>
</html>
