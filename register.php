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
  <a href="login.php" class="w3-bar-item w3-button">log in</a>
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

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container" style="background-color:#BCA37F">
   
    <h1 style="font-family:garamont">MOMOLIST</h1>
  </div>
</div>
<?php

$msg="";
if (isset($_POST["email"]))
{
    // form data:
    $FIRST_NAME = $_POST['fname'];
    $LAST_NAME = $_POST['lname'];
    $BIRTH_DATE = $_POST['birthdate'];
    $EMAIL = $_POST['email'];
    $PASSWORD = $_POST['password'];
    $USERNAME = $_POST['username'];
    $NO_HP = $_POST['hp'];
    if(isset($_POST["user_id"]))
      {
        $USER_ID=$_POST["user_id"];
        $sql="SELECT COUNT(*) AS TOTAL FROM USERDATA WHERE USERNAME='".$USERNAME."' AND USER_ID='".$USER_ID."'";
      }
      else
      {
        $USER_ID="";
        $sql="SELECT COUNT(*) AS TOTAL FROM USERDATA WHERE USERNAME='".$USERNAME."'";
      }


    //1
    $dsn = "mysql:host=localhost;dbname=project_umn";
    $kunci = new PDO($dsn, "root", "");

    
    $stmt = $kunci->prepare($sql);
    $stmt->execute();
    $row=$stmt->fetch(PDO::FETCH_ASSOC);
    $TOTAL= $row["TOTAL"];
    if($TOTAL>0)
    {
      if($USER_ID!="")
      {
        $sql = "UPDATE USERDATA SET PASSWORD='".$PASSWORD."'  WHERE USER_ID='".$USER_ID."'";
        $kunci->query($sql);
        $msg="Password Reseted";
      }
      else
      {
        $msg="username ".$USERNAME. " already exist";
      }

    }
    else
    {
        $sql="SELECT COUNT(*) AS TOTAL FROM USERDATA";
        $stmt = $kunci->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $TOTAL= $row["TOTAL"];
        $USER_ID="TL-".($TOTAL+1);


        $sql = "INSERT INTO USERDATA (USER_ID, FIRST_NAME, LAST_NAME, BIRTH_DATE, EMAIL, PASSWORD, USERNAME, NO_HP, CREATED_DATE, CREATED_BY, MODIFIED_DATE, MODIFIED_BY)
                VALUES ('{$USER_ID}', '{$FIRST_NAME}', '{$LAST_NAME}', '{$BIRTH_DATE}', '{$EMAIL}', '{$PASSWORD}', '{$USERNAME}', '{$NO_HP}', NOW(), '{$USERNAME}', NOW(), '{$USERNAME}')";
        $kunci->query($sql);
        $msg="Data successfully saved with ID number ".$USER_ID;
        ?>
        <table style="width:350px;margin-top:150px;" align=center>  
            <tr><td style="padding:10px;text-align:center;background-color:#AEE2FF;color:#000000;margin-top:250px" colspan=2><?=$msg?><br>Continue to <a  href="login.php">Login</a></td></tr>
           
        </table>
        <?php
        exit;
    }
}
else
{
    $_POST['fname']="";
    $_POST['lname']="";
    $_POST['birthdate']="";
    $_POST['email']="";
    $_POST['password']="";
    $_POST['username']="";
    $_POST['hp']="";
    $_POST["user_id"]="";
}


?>
  




<form id="register" align=center action="register.php"  method="post">
 <table style="width:350px;height:150px;" align=center>  
 <tr><td style="text-align:center;color:#0000ff" colspan=2><?=$msg?></td></tr> 
 <tr><td id="alert1" align=center style="display:none;height:70px;background:#ffaaaa">All fields are required. Please fill all <br /> required fields and submit again.</td></tr>
 <?php
 if(isset($_GET["rst"]))
 {
    if($_GET["rst"]=="1")
    {
?>
<tr><td>User ID</td></tr>
<tr><td><input id="obj-1" style="width:100%;height:35px;" type="text" name="user_id" value="<?=$_POST["user_id"]?>" placeholder="Enter Your User Id..." /></td></tr>

<?php
    }
 }
 ?>
 
<tr><td>Email</td></tr>
<tr><td><input id="obj-1" style="width:100%;height:35px;" type="mail" name="email" value="<?=$_POST["email"]?>" placeholder="Enter Your Email..." /></td></tr>
<tr><td>Username</td></tr>
<tr><td><input id="obj-2" style="width:100%;height:35px;" type="text" name="username" value="<?=$_POST["username"]?>" placeholder="Max 10 Characters" maxlength="10"/></td></tr>
<tr><td>Password</td></tr>
<tr><td><input id="obj-3" style="width:100%;height:35px;" type="password" name="password" value="<?=$_POST["password"]?>" placeholder="Min 8 Characters" minlength="8" maxlength="10" /><input type="checkbox" onclick="myFunction()">Show Password</td></tr>
<tr><td>No.Hp</td></tr>
<tr><td><input id="obj-4" style="width:100%;height:35px;" type="text" name="hp" value="<?=$_POST["hp"]?>" maxlength="16" /></td></tr>
<tr><td>First Name</td></tr>
<tr><td><input id="obj-5" style="width:100%;height:35px;" type="text" name="fname" value="<?=$_POST["fname"]?>" maxlength="20"/></td></tr>
<tr><td>Last Name</td></tr>
<tr><td><input id="obj-6" style="width:100%;height:35px;" type="text" name="lname" value="<?=$_POST["lname"]?>" maxlength="15"/></td></tr>
<tr><td>Birthdate</td></tr>
<tr><td><input id="obj-7" style="width:100%;height:35px;" type="date" name="birthdate" value="<?=$_POST["birthdate"]?>" placeholder="DD/MM/YY"/></td></tr>

 </table>
 <br />
 <button align= center style="background-color:#445D48;color:white;width:27%; height:35px;cursor:pointer" name="BUTTON" type="button" onclick="register()">Submit</button><br>
</form>

<script>
    function register()
    {
        var a=1;
        var obj="";
        var nilai="";
        var pass=true;
        document.getElementById("alert1").style.display="none";
        for(a=1;a<=7;a++)
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
            document.getElementById("register").submit();
         }
    }

    function myFunction() {
  var x = document.getElementById("obj-3");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>

</body>