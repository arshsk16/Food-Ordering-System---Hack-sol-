<?php include('server.php') ?>
<html>
<head>
    <title>Login And Signup form</title>
    <link rel="stylesheet" href="login1.css" />
</head>
<body>
    <div class="hero">
        <div class="formbox">
            <div class="buttonbox">
                <div id="btn"></div>
                <button type="button" class="togglebtn" onclick="Login()">Login</button>
                <button type="button" class="togglebtn" onclick="Signup()">Signup</button>
                </div>   
        <form id="Login" class="inputgrp">
            <input type="text" class="inputf" placeholder="User ID" required>
            <input type="text" class="inputf" placeholder="Enter Password" required>
            <input type="checkbox" class="Chebox"><span>Remermber Password</span>
            <button type="submit" class="subbtn" onclick="window.location.href = 'index.html';">Login</button> 
        </form>
        <form id="Signup" class="inputgrp">
            <input type="text" class="inputf" placeholder="User ID" required>
            <input type="email" class="inputf" placeholder="Email ID" required>
            <input type="text" class="inputf" placeholder="Enter Password" required>
            <input type="checkbox" class="Chebox"><span>I agree to the terms and conditions</span>
            <button type="submit" class="subbtn" onclick="window.location.href = 'login.html';">Signup</button> 
        </form>
    </div>
</div>
<script> 
var x= document.getElementById("Login");
var y= document.getElementById("Signup");
var z= document.getElementById("btn");

function Signup(){
    x.style.left ="-400px";
    y.style.left ="50px";
    z.style.left="110px";
}
function Login(){
    x.style.left ="50px";
    y.style.left ="450px";
    z.style.left="0px";
}
</script>

</body>
</html>