<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title> Hotels in Chiang Mai </title>
    <link rel="icon " type="image/it.jpg" href="/Filezilla/images/it.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #d7f0ffff; margin: 0; padding: 0; }
        .bar1 { background-color:rgba(126, 206, 252, 1);  height: 80px; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; 
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.5); transition: 0.3s; }
        .menu a { margin: 0 50px; text-decoration: none; color: black; }
        .menu a:hover { color: white; background-color: #458efbff; padding: 5px 10px; border-radius: 5px; box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.5) }
        .content { display: flex; padding: 20px; gap: 40px; }
        .product-section { flex: 3; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .product { background: white; border: 1px solid #ccc; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
        .product img { width: 100%; height: auto; border-radius: 10px; }
        .product button { margin-top: 10px; padding: 10px 15px; background-color: #68b9eb; color: white; border: none;  border-radius: 6px; cursor: pointer; }
        .product button:hover { background-color: #43a0d6; }
        .product:hover { transform: scale(1.02);}
        .footer {  text-align: center; padding: 10px; margin: 5px;}

        #cart { flex: 1; background: white; padding: 15px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-height: 90vh; overflow-y: auto; }
        #cart h3 { margin-top: 0; }
        #cart-items div { margin-bottom: 10px; }
        #cart-items button { margin-left: 5px; }

        .img:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .img {
            margin-bottom: 1rem;
            transition: transform 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        #submit-order {
            margin-top: 20px;
            padding: 12px 30px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        #submit-order:hover { background-color: #43a047; }

        .modal-overlay {
            position: fixed; top: 0; left: 0;
            width: 100vw; height: 100vh;
            background-color: rgba(0, 0, 0, 0.5);
            display: none; justify-content: center; align-items: center;
            z-index: 9999;
        }
        .modal-content {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            font-family: 'Kanit', sans-serif;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        .modal-content button {
            margin-top: 20px; padding: 10px 20px;
            background-color: #68b9eb;
            border: none; border-radius: 5px;
            color: white; font-size: 16px;
            cursor: pointer;
        }
        .modal-content button:hover { background-color: #378fd6; }

        .detail-btn {
            margin-left: 10px;
            padding: 12px 20px;
            background-color: #e0e0e0;
            color: #333;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        .detail-btn:hover {
            background-color: #d5d5d5;
        }

        .sidebar {
            background-color: rgb(240, 248, 255);
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px; /* Initially hidden */
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.1);
            transition: 0.3s; /* Smooth transition */
            padding-top: 20px;
        }
        .sidebar.show {
            left: 0; /* Show the sidebar */
        }
        .sidebar a {
            display: block;
            text-decoration: none;
            color: black;
            padding: 15px;
            font-size: 16px;
            border-bottom: 1px solid #ddd;
        }
        .sidebar a:hover { background-color: rgb(2, 81, 192); color: white; }
        .sidebar-toggle-btn {
            font-size: 24px;
            color: black;
            background-color: rgb(52, 136, 254);
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-family: 'Kanit', sans-serif;
        }
        .sidebar-toggle-btn:hover { background-color: rgb(2, 81, 192);  font-family: 'Kanit', sans-serif;}

        ul {
            padding-left: 20px;   /* ระยะขยับจุดเข้ามา */
            margin-left: 0;
        }
        li {
            list-style-position: inside; /* ดันจุดเข้ากรอบ */
        }
        footer{ background-color: #68b9eb; text-align: center; padding: 20px; display: flex; 
        justify-content: center; align-items: flex-start;}
        footer .center{ text-align: center;}
        .footer-title{ width: 100%; text-align: center; margin-bottom: 10px;}
        .footer-center{ text-align: center; }
        .contact-item{ margin-top: 15px; display: flex; gap: 5px;}
        .contact-item a{ text-decoration: none; color: black;}
        .contact-item a:hover{color: white;}
        
        
    </style>
</head>
<body>
    <div class="bar1">
        <h1>สถานที่ท่องเที่ยวเชียงใหม่ 🗺️🌈</h1>
        <div class="menu">
            <a href="homeCH.php">สถานที่เที่ยว</a>
            <a href="ที่พัก/hotelCH.php">ที่พัก</a>
            <a href="contactCH.php">ติดต่อ</a> 
            <a href="aboutCH.php">เกี่ยวกับเรา</a>
        </div>
        
        <div class="menu"><a href="loginCH.php" style="color:black;">ล็อคเอ้าท์</a></div>
    </div>
    
    <h2 style="margin-left: 25px;">หน้าแรก สถานที่พัก</h2>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/264935884.jpg?k=03a067dd8c67c4658990465fc5ea4aaa62c623290d6c93a944d53db0197ae227&o=" alt="">
                <h4>Hotel Aono</h4>
                <p style="text-align: left;"> เป็นโรงแรมเล็กๆ สไตล์มินิมอล ตั้งอยู่ใจกลางเมืองเชียงใหม่ เดินทางสะดวก จะเที่ยวที่ไหนก็ง่าย การตกแต่งของที่นี่คือเรียบง่ายแต่น่ารักสุดๆ ใช้โทนสีขาวคลีนๆ 
                    ตัดกับขอบประตูหน้าต่างลายไม้ ให้ฟีลญี่ปุ่นเบาๆ มินิมอลกำลังดี เฟอร์นิเจอร์ก็เป็นโทนขาวกับไม้ ดูอบอุ่น สบายตา</p>
                <p style="text-align: left;">  ในห้องพักมีครบทั้งแอร์ เครื่องทำน้ำอุ่น และที่สำคัญคือ มีสระว่ายน้ำกลางแจ้ง ด้วย จะว่ายน้ำชิลๆ หรือนั่งเล่นริมสระก็ฟีลดีไปหมด
                    ห้องพักก็กว้าง ทำเลก็ดี อยู่ไม่ไกลจาก เชียงใหม่ไนท์บาซาร์, สถานีรถไฟเชียงใหม่ และยังใกล้คาเฟ่เพียบ</p>
                <li style="text-align: left;">ที่อยู่ : ตำบลช้างคลาน อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่</li>
                <li style="text-align: left;">พิกัด : <a href="https://maps.app.goo.gl/2LXdHCoeAquYgn5u9" target="_blank" rel="noopener" style="text-decoration: none; color: #007bff;">https://maps.app.goo.gl/2LXdHCoeAquYgn5u9</a></li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/Aoyamateiaono " target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/Aoyamateiaono </a></li><br>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='Hotelaono.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/551865398.jpg?k=79131d0f4bc888422a5db346ebdc1e25a6de2bd65c7f1828e88329dbab8be777&o=" alt="">
                <h4>JORN Temporary House</h4>
                <p style="text-align: left;">ถ้าอยากพักแบบ บ้านทั้งหลังกลางเมืองเชียงใหม่ ขอแนะนำ จร-JORN Temporary House บ้านพักสไตล์วินเทจที่รีโนเวตมาจากบ้านเก่า ใกล้มหาวิทยาลัยเชียงใหม่ เหมาะมากสำหรับคนที่มาพักเป็นกลุ่มหรือครอบครัว 
                    เพราะบ้านหลังนี้มีทั้งหมด 3 ห้องนอน 3 ห้องน้ำ 2 ห้องนั่งเล่น และยังมีห้องครัวครบครัน โลเคชั่นดีมากๆ ใกล้ทั้งคาเฟ่ ร้านอาหาร และแหล่งท่องเที่ยวต่างๆ</p>
                <li style="text-align: left;">ที่อยู่ : 99/54 หมู่ 1 ถนนห้วยแก้ว ตำบลช้างเผือก อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่</li>
                <li  style="text-align: left;">พิกัด :<a href="https://maps.app.goo.gl/2vkxgwifKj2WUJby7" target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://maps.app.goo.gl/2vkxgwifKj2WUJby7</a></li>
                <li style="text-align: left;">เว็บไซต์ : <a href="" target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">-</a></li><br>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='hoteljorn.php'">ดูเพิ่มเติม</button>
            </div>
        </div>

    </div>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="https://static.wixstatic.com/media/a20849_c38c022179504523b4b16da2f24235c2~mv2.jpg/v1/fill/w_760,h_420,al_c/a20849_c38c022179504523b4b16da2f24235c2~mv2.jpg">
                <h4>ALEXA Nimman Hostel</h4>
                <p style="text-align: left;">ใครที่มองหา ที่พักเชียงใหม่ ทำเลดี ราคาน่ารักๆ ในตัวเมืองเชียงใหม่ ต้องลองมาพักที่ ALEXA Nimman Hostel 
                    ที่นี่ตั้งอยู่ในย่านนิมมานฯ แหล่งท่องเที่ยวสุดฮิต เดินเที่ยวสะดวก ใกล้ทั้ง คาเฟ่ ร้านอาหาร 
                     ในส่วนของที่พักจะตกแต่งสไตล์มินิมอล เรียบง่ายแต่ดูดี ห้องพักกว้าง นอนสบาย มีพื้นที่ใช้สอยให้ไม่รู้สึกอึดอัด 
                     เหมาะทั้งกับคนที่มาพักคนเดียว มาคู่ หรือมาเที่ยวกับเพื่อน</p>
                <li style="text-align: left;">ที่อยู่ : 2/8 นิมมานเหมินทร์ ตำบลสุเทพ อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่</li>
                <li style="text-align: left;">พิกัด : <a href="https://maps.app.goo.gl/UUzmEcGqyExyuhVv6" target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://maps.app.goo.gl/UUzmEcGqyExyuhVv6</a></li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/alexanimmanhostel " target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/alexanimmanhostel </a></li><br>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='alexanimman.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/167266862.jpg?k=d637f221014eea40487e500b1bf2d7c567cd393edeab00c27bf801494fbade74&o=" alt="">
                <h4>Pillows Boutique Hotel</h4>
                <p style="text-align: left;">ที่พักเชียงใหม่ ฟีลมินิมอล เรียบง่าย แต่มีความน่ารักอบอุ่น ต้องที่นี่เลย Pillows Boutique Hotel ค่ะ ที่พักสวย สะอาด ตัวโรงแรมตกแต่งสไตล์มินิมอล
                    ห้องพักก็กว้างขวางสุดๆ มีทั้งเตียงเดี่ยวและเตียงคู่ให้เลือก ห้องสะอาด สบายตา ทำเลที่ตั้งก็ดีไม่แพ้กัน อยู่ในตัวเมืองเชียงใหม่ 
                    เดินทางสะดวกมาก ใกล้ทั้งสนามบิน สถานีรถไฟเชียงใหม่ เชียงใหม่ไนท์บาซาร์ และ ตลาดวโรรส
                </p>
                <li style="text-align: left;">ที่อยู่ : ตำบลท่าศาลา อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่</li>
                <li  style="text-align: left;">พิกัด : <a href="https://maps.app.goo.gl/eVhYxSfaY3GoP9AS8" target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://maps.app.goo.gl/eVhYxSfaY3GoP9AS8  </a></li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/pillowsboutiquehotel " target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/pillowsboutiquehotel </a></li><br>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='pillows.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://f.ptcdn.info/769/040/000/o3r7yudw87zITbiNZC3-o.jpg" alt="">
                <h4>ปางช้างแม่สา</h4>
                <p style="text-align: left;">ดินแดนช้างไทยที่มีจำนวนมาก มีควาญช้างคอยดูแลอย่างใกล้ชิดเลี้ยงด้วยความรักความผูกพัน  กลุ่มเพื่อนๆบอกว่าที่นี่เป็นสถานที่ที่ดีที่สุด 
                    ได้รับความนิยมโดยเฉพาะชาวต่างชาติ ด้านในปางช้างแม่สา มีการแสดงและกิจกรรมต่าง ๆ</p>
                <li style="text-align: left;">ที่อยู่ : ถนนท่าแพ , 119/9 1096, ตำบลแม่แรม , อำเภอแม่ริม เชียงใหม่ 50180</li>
                <li  style="text-align: left;">พิกัด : ถนนท่าแพ , 119/9 1096, ตำบลแม่แรม , อำเภอแม่ริม เชียงใหม่ 50180</li>
                <li style="text-align: left;">เปิดให้เข้าชม : 09.00 – 15.30</li>
                <li style="text-align: left;">เว็บไซต์ : -</li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/ปางช้าง.php'">ดูเพิ่มเติม</button>
            </div>
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
<script>
    
</script>
</body>
</html>
