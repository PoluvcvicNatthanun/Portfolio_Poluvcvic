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
    <title>IT CMTC SHOP</title>
    <link rel="icon " type="image/it.jpg" href="/Filezilla/images/it.jpg">
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; background-color: #f0f2f5; margin: 0; padding: 0; }
        .bar1 { background-color:rgb(52, 136, 254); height: 80px; display: flex; align-items: center; justify-content: space-between; padding: 0 20px; }
        .menu a { margin: 0 10px; text-decoration: none; color: black; }
        .menu a:hover { color: white; background-color: #68b9eb; padding: 5px 10px; border-radius: 5px; }
        .content { display: flex; padding: 20px; gap: 40px; }
        .product-section { flex: 3; display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .product { background: white; border: 1px solid #ccc; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .product img { width: 100%; height: auto; border-radius: 10px; }
        .product button { margin-top: 10px; padding: 10px 15px; background-color: #68b9eb; color: white; border: none; border-radius: 6px; cursor: pointer; }
        .product button:hover { background-color: #43a0d6; }

        #cart { flex: 1; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.1); max-height: 90vh; overflow-y: auto; }
        #cart h3 { margin-top: 0; }
        #cart-items div { margin-bottom: 10px; }
        #cart-items button { margin-left: 5px; }

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
        <h3>CMTC IT SHOP</h3>
        
        <div class="menu">
            <a href="Home.php">Home</a>
        </div>
        <button class="sidebar-toggle-btn" onclick="toggleSidebar()" style="font-size: medium;">หมวดหมู่อุปกรณ์ >></button>
        <div><a href="login.php" style="color:black;">Logout</a></div>
    </div>
    <div class="sidebar" id="sidebar">
            <h3 style="text-align: center;">หมวดหมู่อุปกรณ์ >></h3>
            <a href="keyboard.php">คีย์บอร์ด</a>
            <a href="mouse.php">เม้าส์</a>
            <a href="hufang.php">หูฟัง</a>
        </div>
    <h4 style="margin-left: 25px;">สินค้าแนะนำ ></h4>
    <div class="content">
        <div class="product-section">
            <div class="product">
                <img src="https://egazone.com/wp-content/uploads/2024/06/PNG_M8G2_1.png" alt="Mouse">
                <h4>Mouse EGA M8 Gen2</h4>
                <p>690 บาท</p>
                <button onclick="addToCart('Mouse EGA M8 Gen2', 690)" style="font-family: 'Kanit', sans-serif;">เพิ่มลงตะกร้า</button>
            </div>
            <div class="product">
                <img src="https://my-test-11.slatic.net/p/34369e48b6599f2adbb9cfb71e97151a.jpg" alt="Keyboard">
                <h4>RK987 Mechanical Keyboard</h4>
                <p>1,290 บาท</p>
                <button onclick="addToCart('Keyboard RGB', 1290)" style="font-family: 'Kanit', sans-serif;">เพิ่มลงตะกร้า</button>
            </div>
            <div class="product">
                <img src="https://assets.central.co.th//adobe/dynamicmedia/deliver/dm-aid--79c4d6c8-cab9-4366-854c-1d1d8c712932/onikuma-red-blackonikumax10devilhorngamingheadset35mmjack-mkp1255849-1.jpg?preferwebp=true&quality=60&width=550" alt="Keyboard">
                <h4>หูฟังเกมมิ่ง Onikuma X10 Devil Horn</h4>
                <p>1,090 บาท</p>
                <button onclick="addToCart('หูฟังเกมมิ่ง Onikuma X10 Devil Horn', 1090)" style="font-family: 'Kanit', sans-serif;">เพิ่มลงตะกร้า</button>
            </div>
            <div class="product">
                <img src="https://media-cdn.bnn.in.th/245113/Signo-Gaming-Controller-Wireless-Excuber-WC-661-1-square_medium.jpg" alt="joygame">
                <h4>จอยคอนโทรลเลอร์ Signo Gaming Controller Wireless Excuber WC-661 Black</h4>
                <p>790 บาท</p>
                <button onclick="addToCart('จอยคอนโทรลเลอร์ Signo Gaming Controller Wireless Excuber WC-661 Black', 790)" style="font-family: 'Kanit', sans-serif;">เพิ่มลงตะกร้า</button>
            </div>
            <div class="product">
                <img src="https://aulathailand.com/wp-content/uploads/2023/07/th-11134207-7qul7-lk26q9tt5smed4.jpg" alt="hufang">
                <h4>หูฟัง AULA F608 WIRELESS GAMING HEADSET7.1</h4>
                <p>2,850 บาท</p>
                <button onclick="addToCart('หูฟัง AULA F608 WIRELESS GAMING HEADSET7.1', 2850)" style="font-family: 'Kanit', sans-serif;">เพิ่มลงตะกร้า</button>
            </div>
        </div>

        <div id="cart">
            <p>👤 ผู้ใช้: <strong><?php echo $_SESSION['username']; ?></strong></p>
            <h3>🛒 ตะกร้าสินค้า</h3>
            <div id="cart-items"></div>
            <p><strong>ราคารวมทั้งหมด:</strong> <span id="total">0</span> บาท</p>
            <form method="POST" action="order.php" onsubmit="return prepareOrderData()">
                <input type="hidden" name="orderData" id="orderData">
                <button id="submit-order" style="font-family: 'Kanit', sans-serif;">ยืนยันคำสั่งซื้อ</button>
                <button type="button" onclick="showDetails()" class="detail-btn" style="font-family: 'Kanit', sans-serif;">ดูสินค้าอย่างละเอียด</button> 
            </form>
        </div>

    </div>

    <div id="modal" class="modal-overlay">
        <div class="modal-content">
            <p style="color: red;">กรุณาเลือกสินค้าก่อนทำการสั่งซื้อ!!</p>
            <button onclick="closeModal()">ตกลง</button>
        </div>
    </div>

    <div id="detail-modal" class="modal-overlay">
        <div class="modal-content" style="text-align: left; max-width: 600px;">
            <h3>รายละเอียดสินค้าในตะกร้า</h3>
            <div id="detail-content"></div>
            <button onclick="closeDetailModal()">ปิด</button>
        </div>
    </div>

<script>
    let cart = {};

    function addToCart(name, price) {
        if (!cart[name]) {
            cart[name] = { price: price, quantity: 1 };
        } else {
            cart[name].quantity++;
        }
        saveCart();
        renderCart();
    }

    function changeQuantity(name, amount) {
        if (cart[name]) {
            cart[name].quantity += amount;
            if (cart[name].quantity <= 0) {
                delete cart[name];
            }
            saveCart();
            renderCart();
        }
    }

    function renderCart() {
        const cartItems = document.getElementById("cart-items");
        const totalDisplay = document.getElementById("total");
        cartItems.innerHTML = "";
        let total = 0;

        for (let name in cart) {
            const item = cart[name];
            total += item.price * item.quantity;
            cartItems.innerHTML += `
                <div>
                    <strong>${name}</strong> - 
                    ${item.price} บาท x ${item.quantity} = ${item.price * item.quantity} บาท <br>
                    <button type="button" onclick="changeQuantity('${name}', 1)">➕</button>
                    <button type="button" onclick="changeQuantity('${name}', -1)">➖</button>
                </div>`;
        }

        totalDisplay.textContent = total;
    }

    function saveCart() {
        localStorage.setItem("cart", JSON.stringify(cart));
    }

    function loadCart() {
        const savedCart = localStorage.getItem("cart");
        if (savedCart) {
            cart = JSON.parse(savedCart);
        }
    }

    window.onload = function() {
        loadCart();
        renderCart();
    };

    function showDetails() {
        if (Object.keys(cart).length === 0) {
            showModal();
            return;
        }

        const detailContent = document.getElementById("detail-content");
        detailContent.innerHTML = "";

        for (let name in cart) {
            const item = cart[name];
            const imageUrl = getImageURL(name);
            detailContent.innerHTML += `
                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                    <img src="${imageUrl}" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px; border-radius: 8px;">
                    <div>
                        <strong>${name}</strong><br>
                        ราคา: ${item.price} บาท<br>
                        ราคารวม: ${item.price * item.quantity} บาท<br>
                        จำนวน: ${item.quantity}
                    </div>
                </div>
            `;
        }

        document.getElementById("detail-modal").style.display = "flex";
    }

    function closeDetailModal() {
        document.getElementById("detail-modal").style.display = "none";
    }

    function showModal() {
        document.getElementById("modal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("modal").style.display = "none";
    }

    function prepareOrderData() {
        if (Object.keys(cart).length === 0) {
            showModal();
            return false;
        }
        const orderDataInput = document.getElementById("orderData");
        orderDataInput.value = JSON.stringify(cart);
        return true;
    }
    function getImageURL(name) {
        const images = {
            "Mouse EGA M8 Gen2": "https://aulathailand.com/wp-content/uploads/2023/07/S503.jpg",
            "Keyboard RGB": "https://my-test-11.slatic.net/p/34369e48b6599f2adbb9cfb71e97151a.jpg",
            "หูฟังเกมมิ่ง Onikuma X10 Devil Horn": "https://assets.central.co.th//adobe/dynamicmedia/deliver/dm-aid--79c4d6c8-cab9-4366-854c-1d1d8c712932/onikuma-red-blackonikumax10devilhorngamingheadset35mmjack-mkp1255849-1.jpg?preferwebp=true&quality=60&width=550",
            "จอยคอนโทรลเลอร์ Signo Gaming Controller Wireless Excuber WC-661 Black": "https://media-cdn.bnn.in.th/245113/Signo-Gaming-Controller-Wireless-Excuber-WC-661-1-square_medium.jpg",
            "หูฟัง AULA F608 WIRELESS GAMING HEADSET7.1": "https://aulathailand.com/wp-content/uploads/2023/07/th-11134207-7qul7-lk26q9tt5smed4.jpg"
    };

    return images[name] || "https://via.placeholder.com/80";
    }


    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('show'); // Toggle the 'show' class to display or hide the sidebar
    }
</script>
</body>
</html>
