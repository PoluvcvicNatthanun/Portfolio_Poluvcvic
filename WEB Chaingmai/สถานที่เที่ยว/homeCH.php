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
        .bar1 { background-color:rgba(126, 206, 252, 1); height: 80px; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; 
            box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.5);
            transition: 0.3s; }
        .menu a { margin: 0 10px; text-decoration: none; color: black; }
        .menu a:hover { color: white; background-color: #458efbff; padding: 5px 10px; border-radius: 5px; box-shadow: 2px 0px 10px rgba(0, 0, 0, 0.5) }
        .content { display: flex; padding: 20px; gap: 40px; }
        .product-section { flex: 3; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .product { background: white; border: 1px solid #ccc; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); transition: transform 0.3s ease; }
        .product img { width: 100%; height: auto; border-radius: 10px; }
        .product button { margin-top: 10px; padding: 10px 15px; background-color: #68b9eb; color: white; border: none;  border-radius: 6px; cursor: pointer; }
        .product button:hover { background-color: #43a0d6; }
        .product:hover { transform: scale(1.02);}

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
    </style>
</head>
<body>
    <div class="bar1">
        <h1>สถานที่ท่องเที่ยวเชียงใหม่ 🗺️🌈</h1>
        <div class="menu">
            <a href="homeCH.php">หน้าแรกท่องเที่ยว</a>
            <a href="#">สถานที่เที่ยว</a>
            <a href="#">ที่พัก</a>
            <a href="#">ติดต่อ</a> 
            <a href="#">เกี่ยวกับเรา</a>
        </div>
        
        <div class="menu"><a href="loginCH.php" style="color:black;">ล็อคเอ้าท์</a></div>
    </div>
    
    <h2 style="margin-left: 25px;">หน้าแรก</h2>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="https://www.ananda.co.th/blog/thegenc/wp-content/uploads/2023/11/shutterstock_2091837973-1-825x550.jpg" alt="">
                <h4>ดอยอินทนนท์</h4>
                <p style="text-align: left;"> ดอยอินทนนท์ ถือเป็นภูเขาที่สูงที่จะในประเทศไทย ด้วยความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้มีสภาพอากาศที่เย็นตลอดทั้งปี</p>
                <li style="text-align: left;">ที่อยู่ : ตำบลบ้านหลวง อำเภอจอมทอง จังหวัดเชียงใหม่</li>
                <li style="text-align: left;">พิกัด : <a href="https://maps.app.goo.gl/GoqQTrsmwui7kqBE9" target="_blank" rel="noopener" style="text-decoration: none; color: #007bff;">https://maps.app.goo.gl/GoqQTrsmwui7kqBE9</a></li>
                <li style="text-align: left;">เปิดให้เข้าชม :  05.00-18.00 น.</li>
                <li style="text-align: left;">เว็บไซต์ : <a href="https://www.facebook.com/DoiInthanonNationalPark" target="_blank" rel="noopener" style="text-decoration: none; color:#007bff">https://www.facebook.com/DoiInthanonNationalPark</a></li>
                <button style="font-family: 'Kanit', sans-serif;" onclick="window.location.href='สถานที่เที่ยว/ดอยอินทนนท์.php'">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://upload.wikimedia.org/wikipedia/commons/6/68/Chiang_Mai_-_East_gate_of_the_city_wall_-_0001.jpg" alt="">
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
            1. <a href="#" style="text-decoration: none; color: #007bff;" target="_blank" >วัดพระธาตุดอยสุเทพ</a>
            <div class="img">
                <a href="homeCH.php" target="_blank"><img style="height: 200px; width: 350px; border-radius: 10px;"  src="https://upload.wikimedia.org/wikipedia/commons/c/c1/Wat_Phra_That_Doi_Suthep_%28I%29.jpg"></a>
            </div> 
            2. <a href="#"style="text-decoration: none; color: #007bff;" target="_blank">ดอยอินทนนท์</a>
            <div class="img">
                <a href="#" target="_blank"><img style="height: 200px; width: 350px; border-radius: 10px;"  src="https://image-tc.galaxy.tf/wijpeg-sxrfid5inslt46adwg0pwpho/intanon_standard.jpg?crop=112%2C0%2C1777%2C1333"></a>
            </div>
            3. <a href="#"style="text-decoration: none; color: #007bff;" target="_blank">เมืองเก่าเชียงใหม่ (คูเมือง)</a>
            <div class="img">
                <img style="height: 200px; width: 350px; border-radius: 10px;"  src="https://www.panasm.com/wp-content/uploads/2017/09/shutterstock_555493696.jpg">
            </div>
            4. <a href="#"style="text-decoration: none; color: #007bff;" target="_blank">สวนพฤกษศาสตร์สมเด็จพระนางเจ้าสิริกิติ์</a>
            <div class="img">
                <img style="height: 200px; width: 350px; border-radius: 10px;"  src="https://chillpainai.com/storage/scoop/cover/2016-06-01-14-29-49-02.jpg">
            </div>
            5. <a href="#"style="text-decoration: none; color: #007bff;" target="_blank">ปางช้างแม่สา</a>
            <div class="img">
                <img style="height: 200px; width: 350px; border-radius: 10px;"  src="https://f.ptcdn.info/769/040/000/o3r7yudw87zITbiNZC3-o.jpg">
            </div>
            
        </div>
    </div>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="https://www.ananda.co.th/blog/thegenc/wp-content/uploads/2023/11/shutterstock_2091837973-1-825x550.jpg" alt="">
                <h4>ดอยอินทนนท์</h4>
                <p>ดอยอินทนนท์ ถือเป็นภูเขาที่สูงที่จะในประเทศไทย ด้วยความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้มีสภาพอากาศที่เย็นตลอดทั้งปี</p>
                <button style="font-family: 'Kanit', sans-serif;">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://www.ananda.co.th/blog/thegenc/wp-content/uploads/2023/11/shutterstock_2091837973-1-825x550.jpg" alt="">
                <h4>ดอยอินทนนท์</h4>
                <p>ดอยอินทนนท์ ถือเป็นภูเขาที่สูงที่จะในประเทศไทย ด้วยความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้มีสภาพอากาศที่เย็นตลอดทั้งปี</p>
                <button style="font-family: 'Kanit', sans-serif;">ดูเพิ่มเติม</button>
            </div>
            <div class="product">
                <img src="https://www.ananda.co.th/blog/thegenc/wp-content/uploads/2023/11/shutterstock_2091837973-1-825x550.jpg" alt="">
                <h4>ดอยอินทนนท์</h4>
                <p>ดอยอินทนนท์ ถือเป็นภูเขาที่สูงที่จะในประเทศไทย ด้วยความสูงจากระดับน้ำทะเล 2,565 เมตร จึงทำให้มีสภาพอากาศที่เย็นตลอดทั้งปี</p>
                <button style="font-family: 'Kanit', sans-serif;">ดูเพิ่มเติม</button>
            </div>
        </div>
    </div>


<script>
    
</script>
</body>
</html>
