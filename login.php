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

       

<?php
$msg="";
$dsp="display:none";
 if(isset($_POST["username"]) && isset($_POST["password"]))
 {
        $dsn = "mysql:host=localhost;dbname=project_umn";
        $kunci = new PDO($dsn, "root", "");

        $sql="SELECT COUNT(*) AS TOTAL FROM USERDATA WHERE USERNAME='".$_POST["username"]."' AND PASSWORD='".$_POST["password"]."'";
        $stmt = $kunci->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $TOTAL= $row["TOTAL"];
       
        if($TOTAL==1)
        {
            $sql="SELECT USER_ID FROM USERDATA WHERE USERNAME='".$_POST["username"]."' AND PASSWORD='".$_POST["password"]."'";
            $stmt = $kunci->prepare($sql);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);
            $USER_ID= $row["USER_ID"];
            $cookie_value = $USER_ID;
            $cookie_name="user";
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            header("Location: //localhost/UTS_LAB/todolist.php");
            exit();
        }
        else
        {
            $msg="Login failed, <a href='register.php?rst=1'></a>";
            $dsp="";
        }

 }

  ?>









<form id="login" align=center action="login.php"  method="post">
 <table style="width:350px;height:150px;margin-top:70px" align=center> 
<tr><td style="text-align: center;font-size:35px">LOG IN</td></tr>
<tr><td id=alert1 style="<?=$dsp?>;padding:10px;text-align:center;background-color:#FFDFDF;color:#000000;" colspan=2><?=$msg?><a  href="register.php?rst=1">reset password?</a></td></tr>
<tr><td>Username</td></tr>
<tr><td><input id="obj-1" style="width:100%;height:35px;" type="text" name="username" /></td></tr>
<tr><td>Password</td></tr>
<tr><td><input id="obj-2" style="width:100%;height:35px;" type="password" name="password" placeholder="Min 8 Characters" maxlength="10"/>
<font style='cursor:pointer;font-size:12px' onmousedown='view_pass()' onmouseup='hide_pass()'>view</font></td></tr>

</table>
 <br />
 <button align= center style="background-color:#445D48;color:white;width:27%; height:35px;cursor:pointer" name="BUTTON" type="button" onclick="login()">Submit</button><br>
</form>


<script>
    function view_pass()
    {
        document.getElementById("obj-2").type="text"
    }
    function hide_pass()
    {
        document.getElementById("obj-2").type="password"
    }

    function login()
    {
        var a=1;
        var obj="";
        var nilai="";
        var pass=true;
     
        document.getElementById("alert1").style.display="none";
        for(a=1;a<=2;a++)
        {
            obj="obj-"+a;
            nilai=document.getElementById(obj).value;
            if(nilai=="")
            {
                document.getElementById(obj).style.backgroundColor="#FFDFDF";
                document.getElementById("alert1").style.display="";
                pass=false;
            }
            else
            {
                document.getElementById(obj).style.backgroundColor="#ffffff";
            }

        }

        

         if(pass==true)
         {
            document.getElementById("login").submit();
         }
         else
         {
            document.getElementById("alert1").innerHTML="All fields are required. Please fill all required fields and submit again.";
            document.getElementById("alert1").style.display="";
         }
    }

</script>
</body>