const form = document.getElementById("login-form");

form.addEventListener("submit", function(event){

    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if(username === "" || password === "") {

        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
        return;
    } else {

        window.location.href = "index.html";

    }

});