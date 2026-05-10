const form = document.getElementById("login-form");

form.addEventListener("submit", function(event){

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if(username === "" || password === "") {

        event.preventDefault();

        alert("กรุณากรอกข้อมูลให้ครบถ้วน");
    }

});