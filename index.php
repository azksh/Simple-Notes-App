
  
<?php
$url = 'background.jpg';
$cookie_name = "user";
if(isset($_GET["logout"]))
{
    setcookie($cookie_name, "xxxx", time() - 3600,"/");
}
?>

<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">
<body style="background-image:url('background.jpg');background-size: cover;background-top:50px">

<script>
function w3_open() {
  document.getElementById("main").style.marginLeft = "25%";
  document.getElementById("mySidebar").style.width = "25%";
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("openNav").style.display = 'none';
}
function w3_close() {
  document.getElementById("main").style.marginLeft = "0%";
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("openNav").style.display = "inline-block";
}
</script>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none;background-color:#A4907C" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large"
  onclick="w3_close()">Close &times;</button>
  <a href="index.php" class="w3-bar-item w3-button">Home</a>
  <a href="aboutus.php" class="w3-bar-item w3-button">About Us</a>
  <a href="login.php" class="w3-bar-item w3-button">Log in</a>
</div>

<?php
  if(isset($_GET["user_id"]))
  {
    ?>
      <a href="index.php?logout=1" class="w3-bar-item w3-button">Logout</a>
    <?php
  }
 
  ?>  
</div>

<div id="main" style="height:595px;">

<div class="w3-teal" style="background-color:#">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container" style="background-color:#BCA37F">
   
    <h1 style="font-family:garamont">MOMOLIST</h1>
  </div>
</div>

<p align=center style="text-align: center;font-size:20px;font-family:garamond;margin-top:70px"><b>Welcome to momolist, the world of planning made easier.Find All the Tools You Need Here!<b></p>

<form style="margin-top:40px" id="kalkulator" align=center action="proses_bmi.php"  method="post">
 <table style="width:250px;height:50px;margin-top:0px;" align=center>   
 <tr><td style="display:none;text-align: center;font-size:15px;font-family:garamond;">Welcome to momolist, the world of planning made easier. Find All the Tools You Need Here!</td></tr>
 <tr><td style="text-align: center;font-size:35px">SIGN UP</td></tr>
<tr><td>Email</td></tr>
<tr><td><input id="obj-1" style="width:100%;height:35px;" type="mail" name="email" placeholder="Enter your email address..."/></td></tr>
 <tr><td nowrap> 
 <button align= center style="background-color:#445D48;color:white;width:100%; height:35px;cursor:pointer" name="BUTTON" type="button" onclick="register()">Continue with email</button><br>
 <p>Already have an account? Please <a class="underline-link" style="width:50px;" href="login.php">Login</a> to continue</p><br>
 </td></tr>

</table>
 
 <button align= center style="background-color:white;border: 1px solid black;;color:black;width:27%; height:35px;display:none" name="BUTTON" type="button" onclick="kirim()">Continue with Google</button><br><br>
 <button align= center style="background-color:white;border: 1px solid black;;color:black;width:27%; height:35px;display:none;" name="BUTTON" type="button" onclick="kirim()">Continue with Apple</button>
</form>

<script>
    function register()
    {
        
      window.open("register.php","register");
        

        // if(document.getElementById("rad-1").checked==false && document.getElementById("rad-2").checked==false)

    }
    function kirim()
    {
        
      window.open("REGISTER.php","register");
        

        // if(document.getElementById("rad-1").checked==false && document.getElementById("rad-2").checked==false)

    }
</script>
</body>