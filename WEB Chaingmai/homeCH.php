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
    <title>Chaing mai</title>
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
        <a href="homeCH.php" target="_blank" style="text-decoration: none;color: black;"><h1>สถานที่ท่องเที่ยวเชียงใหม่ 🗺️🌈</h1></a>
        <div class="menu">
            <a href="homeCH.php">สถานที่เที่ยว</a>
            <a href="ที่พัก/hotelCH.php">ที่พัก</a>
            <a href="contactCH.php">ติดต่อ</a> 
            <a href="aboutCH.php">เกี่ยวกับเรา</a>
        </div>
        
        <div class="menu"><a href="loginCH.php" style="color:black;">ล็อคเอ้าท์</a></div>
    </div>
    
    <h2 style="margin-left: 25px;">หน้าแรก สถานที่ท่องเที่ยว</h2>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="สถานที่เที่ยว/photo/ดอยอินทนนท์/ดอยอินทนนท์.jpg" alt="">
                <h4>ดอยอินทนนท์</h4>
                <p style="text-align: left;"> ดอยอินทนนท์ ถือเป็นภูเขาที่สูงที่จะในประเทศไทย ด้วยความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้มีสภาพอากาศที่เย็นตลอดทั้งปี</p>
                <li style="text-align: left;">ที่อยู่ : ตำบลบ้านหลวง อำเภอจอมทอง จังหวัดเชียงใหม่</li>
                <li style="text-align: left;">พิกัด : <a href="https://maps.app.goo.gl/GoqQTrsmwui7kqBE9" target="_blank" rel="noopener" style="text-decoration: none; color: #007bff;">https://maps.app.goo.gl/GoqQTrsmwui7kqBE9</a></li>
                <li style="text-align: left;">เปิดให้เข้าชม :  05.00-18.00 น.</li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/DoiInthanonNationalPark" target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/DoiInthanonNationalPark</a></li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/ดอยอินทนนท์.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="สถานที่เที่ยว/photo/ประตูท่าแพ/ประตูท่าแพ.jpg" alt="">
                <h4>ประตูท่าแพ</h4>
                <p style="text-align: left;">ประตูท่าแพ เป็นประตูเมืองที่อยู่ทางด้านทิศตะวันออกของเมืองเชียงใหม่ชั้นใน ซึ่งก็คือพื้นที่สี่เหลี่ยมที่ล้อมรอบด้วยคูเมืองนั่นเอง บริเวณประตูท่าแพจะเห็นแนวกำแพงเมืองเก่าซึ่งสร้างด้วยอิฐ มีความสวยงาม และเป็นเอกลักษณ์ 
                    บริเวณประตูท่าแพมีลานกว้างซึ่งใช้จัดงานเทศกาลต่างๆ และยังเป็นจุดเริ่มต้นของ ถนนคนเดินท่าแพ ซึ่งจัดขึ้นทุกๆ วันอาทิตย์อีกด้วย</p>
                <li style="text-align: left;">ที่อยู่ : ตำบลบ้านหลวง อำเภอจอมทอง จังหวัดเชียงใหม่</li>
                <li  style="text-align: left;">พิกัด :<a href="https://maps.app.goo.gl/wo8KinkKZyQTqsHz5" target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://maps.app.goo.gl/wo8KinkKZyQTqsHz5</a></li>
                <li style="text-align: left;">เปิดให้เข้าชม : สามารถเที่ยวชมได้ตลอดทั้งวัน.</li>
                <li style="text-align: left;">เว็บไซต์ : -</li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/ประตูท่าแพ.php'">ดูเพิ่มเติม</button>
            </div>
        </div>

        <div id="cart">
            <strong><p>5 อันดับสถานที่ท่องเที่ยวในเชียงใหม่</p></strong>
            1. <a onclick="window.location.href='สถานที่เที่ยว/วัดพระธาตุ.php'" style="text-decoration: none; color: #007bff;" target="_blank" >วัดพระธาตุดอยสุเทพ</a>
            <div class="img">
                <a onclick="window.location.href='สถานที่เที่ยว/วัดพระธาตุ.php'" target="_blank"><img style="height: 200px; width: 400px; border-radius: 10px;"  src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Wat_Phra_That_Doi_Suthep_%28I%29.jpg"></a>
            </div> 
            2. <a onclick="window.location.href='สถานที่เที่ยว/ดอยอินทนนท์.php'"style="text-decoration: none; color: #007bff;" target="_blank">ดอยอินทนนท์</a>
            <div class="img">
                <a onclick="window.location.href='สถานที่เที่ยว/ดอยอินทนนท์.php'" target="_blank"><img style="height: 200px; width: 400px; border-radius: 10px;"  src="https://image-tc.galaxy.tf/wijpeg-sxrfid5inslt46adwg0pwpho/intanon_standard.jpg?crop=112%2C0%2C1777%2C1333"></a>
            </div>
            3. <a onclick="window.location.href='สถานที่เที่ยว/ประตูท่าแพ.php'"style="text-decoration: none; color: #007bff;" target="_blank">เมืองเก่าเชียงใหม่ (คูเมือง)</a>
            <div class="img">
                <a onclick="window.location.href='สถานที่เที่ยว/ประตูท่าแพ.php'"style="text-decoration: none; color: #007bff;" target="_blank"><img style="height: 200px; width: 400px; border-radius: 10px;"  src="https://www.panasm.com/wp-content/uploads/2017/09/shutterstock_555493696.jpg"></a>
            </div>
            4. <a onclick="window.location.href='สถานที่เที่ยว/สวนพฤกษศาสตร์.php'"style="text-decoration: none; color: #007bff;" target="_blank">สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์</a>
            <div class="img">
                <a onclick="window.location.href='สถานที่เที่ยว/สวนพฤกษศาสตร์.php'"style="text-decoration: none; color: #007bff;" target="_blank"><img style="height: 200px; width: 400px; border-radius: 10px;"  src="https://chillpainai.com/storage/scoop/cover/2016-06-01-14-29-49-02.jpg"></a>
            </div>
            5. <a onclick="window.location.href='สถานที่เที่ยว/ปางช้าง.php'"style="text-decoration: none; color: #007bff;" target="_blank">ปางช้างแม่สา</a>
            <div class="img">
                <a onclick="window.location.href='สถานที่เที่ยว/ปางช้าง.php'"stylตe="text-decoration: none; color: #007bff;" target="_blank"><img style="height: 200px; width: 400px; border-radius: 10px;"  src="https://f.ptcdn.info/769/040/000/o3r7yudw87zITbiNZC3-o.jpg"></a>
            </div>
            
        </div>
    </div>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="สถานที่เที่ยว/photo/วัดพระธาตุดอยสุเทพ/พระธาตุดอยสุเทพ.jpg" alt="">
                <h4>วัดพระธาตุดอยสุเทพ</h4>
                <p style="text-align: left;">วัดพระธาตุดอยสุเทพ นั้นเป็นปูชนียสถานคู่เมืองเชียงใหม่มาตั้งแต่โบราณ ตั้งอยู่บนยอดดอยสุเทพ  
                    นอกจากนี้ยังมี บันไดนาคเจ็ดเศียร ซึ่งทอดยาวขึ้นไป 300 ขั้น และ เจดีย์สีทองทรงเชียงแสน เป็นศิลปะล้านนาที่งดงาม 
                    อีกทั้งที่นี่เป็นพระธาตุประจำคนเกิดปีมะแมตามคติความเชื่อล้านนาอีกด้วย</p>
                <li style="text-align: left;">ที่อยู่ : 9 หมู่ที่ 9 อำเภอเมืองเชียงใหม่ จังหวัดเชียงใหม่</li>
                <li style="text-align: left;">พิกัด :<a href="https://maps.app.goo.gl/xVRzVnF8acZrA5RWA" target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://maps.app.goo.gl/xVRzVnF8acZrA5RWA</a></li>
                <li style="text-align: left;">เปิดให้เข้าชม : 06.00-20.00 น.</li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/วัดพระธาตุดอยสุเทพ" target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/วัดพระธาตุดอยสุเทพ</a></li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/วัดพระธาตุ.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="สถานที่เที่ยว/photo/สวนพฤกษศาสตร์/สวนพฤกษศาสตร์.jpg" alt="">
                <h4>สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์</h4>
                <p style="text-align: left;">สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์ สวนสวยๆ ที่ตั้งอยู่ใน ตำบลแม่แรม อำเภอแม่ริม จังหวัดเชียงใหม่ มีพื้นที่กว่า 3,500 ไร่ เป็นสถานที่ที่รวบรวมและอนุรักษ์พรรณไม้ต่างๆ เอาไว้ 
                    โดยการปลูกให้สอดคล้องกับธรรมชาติมากที่สุด ซึ่งมีทั้งกลุ่มอาคารเรือนกระจกบนยอดเขา ที่มีความสวยงาม 
                    รวมไปถึงมีความรู้อัดแน่นอยู่มากมาย ทำให้สวนนี้ เป็นอีกสถานที่ท่องเที่ยวพักผ่อน และสถานที่ศึกษาธรรมชาตินั่นเอง</p>
                <li style="text-align: left;">ที่อยู่ : 100 หมู่ 9 ตำบลแม่แรม อำเภอแม่ริม จังหวัดเชียงใหม่</li>
                <li  style="text-align: left;">พิกัด :<a href="https://goo.gl/maps/PpD4zzZnjNt6jXgE9   " target="_blank"  rel="noopener" style="text-decoration: none; color:#007bff">https://goo.gl/maps/PpD4zzZnjNt6jXgE9   </a></li>
                <li style="text-align: left;">เปิดให้เข้าชม : 09.00-16.00 น.</li>
                <li style="text-align: left;">เค่าเข้าชม : คนไทย ผู้ใหญ่ 40 บาท เด็ก 20 บาท , ต่างชาติ ผู้ใหญ่ 100 บาท เด็ก 50 บาท</li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/qsbgcm/" target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/qsbgcm/</a></li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/สวนพฤกษศาสตร์.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="สถานที่เที่ยว/photo/ปางช้างแม่สา/ช้างปาง.jpg" alt="">
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
