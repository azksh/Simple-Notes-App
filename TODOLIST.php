<?php
$servername = "localhost";
$username = "root";
$dbname = "project_umn";
$password="";

$conn = new mysqli($servername, $username, $password, $dbname);      
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
//================================================================
if(isset($_POST["USER_ID"]))
{

  if(isset($_POST["TITLE"]))
  {
    $cookie_value = $_POST["TITLE"];
    setcookie("title", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
  }
     
    if($_POST["NO_REC"]>=0) 
    { 
            $NAMA=$_POST["USER_ID"];
            $sql = "SELECT * FROM USERDATA WHERE USER_ID='".$_POST["USER_ID"]."'";
            $result = $conn->query($sql);
            if($result->num_rows > 0) 
            {
              $row = $result->fetch_assoc();
              $NAMA=$row["FIRST_NAME"];
            }
        
          if($_POST["NO_REC"]==0)
          {
                    $sql = "INSERT INTO TASK_NOTE (USER_ID,TITLE,TASK,STATUS,PROGRESS,CREATED_DATE,CREATED_BY,UPDATE_TIME,UPDATE_USER)
                    VALUES ('".$_POST["USER_ID"]."','".$_POST["TITLE"]."','".$_POST["TASK"]."', '".$_POST["CHECK"]."','".$_POST["PROGRESS"]."',NOW(),'".$NAMA."',NOW(),'".$NAMA."')";
                    
                    if ($conn->query($sql) === TRUE) 
                    {
                      $last_id = $conn->insert_id;
                      $_POST["NO_REC"]=$last_id;
                    }
                    else
                    {
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    }
          }
          else
          {
                $sql = "UPDATE TASK_NOTE SET USER_ID='".$_POST["USER_ID"]."', TITLE='".$_POST["TITLE"]."',TASK='".$_POST["TASK"]."',STATUS='".$_POST["CHECK"]."',
                PROGRESS='".$_POST["PROGRESS"]."',UPDATE_TIME=NOW(),UPDATE_USER='".$NAMA."' WHERE NO_REC=".$_POST["NO_REC"];
                if ($conn->query($sql) === TRUE) 
                    {
                      //$last_id = $conn->insert_id;           
                    }
                    else
                    {
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    }
          }

      
    }
    else
    {
                 $sql = "DELETE FROM TASK_NOTE WHERE USER_ID='".$_POST["USER_ID"]."' AND NO_REC=".abs($_POST["NO_REC"]);
                if ($conn->query($sql) === TRUE) 
                    {
                      //$last_id = $conn->insert_id;           
                    }
                    else
                    {
                    //echo "Error: " . $sql . "<br>" . $conn->error;
                    }
    }
    echo chr(10);
    echo "NO ID =".$_POST["NO_REC"].chr(10);
    echo "USER ID =".$_POST["USER_ID"].chr(10);
    echo "TASK =".$_POST["TASK"].chr(10);
    echo "CHECK =".$_POST["CHECK"].chr(10);
    echo "PROGRESS =".$_POST["PROGRESS"].chr(10);
    echo "TITLE =".$_POST["TITLE"].chr(10);
  exit;
}
//===============================================================================

$cookie_name = "user";
if(isset($_COOKIE[$cookie_name])) 
{
    $_GET["user_id"]=$_COOKIE[$cookie_name];
}

$NAMA="";
if(isset($_GET["user_id"]))
{
   
    $sql = "SELECT * FROM USERDATA WHERE USER_ID='".$_GET["user_id"]."'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      $row = $result->fetch_assoc();
      $NAMA=$row["FIRST_NAME"];
    }
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
  
  <?php
  if(isset($_GET["user_id"]))
  {
    ?>
      <a href="index.php?logout=1" class="w3-bar-item w3-button">Log out</a>
    <?php
  }
  else
  {
    ?>
      <a href="login.php?login=1" class="w3-bar-item w3-button">Login</a>
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


$cookie_name = "user";
if(isset($_GET["logout"]))
{
    setcookie($cookie_name, "", time() - 3600,"/");
    exit;
}


if(isset($_COOKIE[$cookie_name])) 
{
    $_GET["user_id"]=$_COOKIE[$cookie_name];
}


if(!isset($_GET["user_id"]))
{
  exit;
}

$cookie_value = $_GET["user_id"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day


if(isset($_COOKIE["title"]) && !isset($_POST["TITLE"])) 
{
    $_POST["TITLE"]=$_COOKIE["title"];
}

if(isset($_POST["TITLE"]))
{
  $cookie_value = $_POST["TITLE"];
  setcookie("title", $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
}
else
{
  $_POST["TITLE"]="GENERAL";
}

    $dropdown_list="Waiting time=#FFDFDF;Cancel=#FFAAAA;Waiting Buget=#AAAAFF;Closed=#AAFFAA;";
    $sql = "SELECT * FROM DROPDOWN_LIST WHERE DROPDOWN_NAME='NOTION'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) 
    {
      $row = $result->fetch_assoc();
      $dropdown_list=$row["DROPDOWN_LIST"];
     }


$progress_list=explode(";",$dropdown_list);

$selector="<select id='PROGRESS_LIST-XX' style='width:25;float:right' onchange='dropdown(this.id)'>";
for($a=0;$a<count($progress_list);$a++)
{
    if($progress_list[$a]!="")
    {
        $prog_warna=explode("=",$progress_list[$a]);
        $selector.="<option value='".$prog_warna[0]."' style='background:".$prog_warna[1]."' >".$prog_warna[0]."</option>";
    }
}
$selector.="<option value='' selected></option>";
$selector.="</select>";


$sql = "SELECT DISTINCT(TITLE) FROM TASK_NOTE WHERE TITLE IS NOT NULL AND USER_ID='".$_GET["user_id"]."'";
$result = $conn->query($sql);
$selector_title="<select id='titleX' style='width:25;float:left' onchange='dropdown_title(this.id)'>";
if($result->num_rows > 0) 
{
  while($row = $result->fetch_assoc())
  {
    if($row["TITLE"]!="")
    {
       $selector_title.="<option value='".$row["TITLE"]."' >".$row["TITLE"]."</option>";
    }
  }
}
$selector_title.="<option value='' selected></option>";
$selector_title.="</select>";

echo "<form id='mytitle' style='display:none'  method='post' action='todolist.php'>";
echo "<input id='title_1' name='TITLE'>";
echo "</form>";

echo "<table align=center style='margin-top:50px;'>";
echo "<tr><td style='height:100px;font-size:25px;font-family:Lucida Handwriting;text-align:center'>Hai ".$NAMA." !</td></tr>"; 
echo "<tr><td>";
echo "<table style='width:100%'><tr><td style='padding:3px;width:20px;' nowrap>".$selector_title."</td><td style='font-size:30px;width:20px'>&#9998</td><td><input id='title' style='background:transparent;font-size:15px;border-width:0px;border-bottom-width:1px;width:100%' value='".$_POST["TITLE"]."'></td><td style='width:50px'><b style='font-size:30px;cursor:pointer'onclick='submit_title()'>&#128270</b></td></tr></table>";
echo "</td></tr>";
echo "<tr style='display:none'><td><input id='user_id' value='".$_GET["user_id"]."'></td></tr>";
echo "<tr style='background-color:#ffffff'><td>";
    echo "<table border=1 style='border-collapse:collapse' id='todolist' ><tr>";
    echo "<td style='background:#BFB29E;padding:3px;text-align:center'>No</td>";
    echo "<td style='background:#BFB29E;padding:3px;text-align:center'>&#128203;Task</td>";
    echo "<td style='background:#BFB29E;padding:3px;text-align:center'>Done </td>";
    echo "<td style='background:#BFB29E;padding:5px;text-align:center' colspan=2>&#128204;Progress</td>";
    echo "</tr>";
    if(isset($_POST["USER_ID"]))
    {
      $NAMA=$_POST["USER_ID"];
    }
    else
    {
      $NAMA="";
    }
    
    $sql = "SELECT * FROM TASK_NOTE WHERE USER_ID='".$_GET["user_id"]."' ORDER BY STATUS ASC";
    if(isset($_POST["TITLE"]))
    {
      $sql = "SELECT * FROM TASK_NOTE WHERE USER_ID='".$_GET["user_id"]."' AND TITLE='".$_POST["TITLE"]."' ORDER BY STATUS ASC";
    }
    $result = $conn->query($sql);
    $a=0;
    $last_obj=0;
    if($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc())
      {
     
          $NAMA=$row["USER_ID"];
          $NO_REC_ID="NO_REC-".$a;
          $TASK_ID="TASK-".$a;
          $CHECK_ID="CHECK-".$a;
          $PROGRESS_ID="PROGRESS-".$a;
          $SELECTOR=str_replace("XX",$a,$selector);
          if($row["STATUS"]=="done")
          {
            $checked="checked";
          }
          else
          {
            $checked="";
          }


          $split_1=explode($row["PROGRESS"]."=",$dropdown_list);
          if(count($split_1)==2)
          {
            $split_1=explode(";",$split_1[1]);
            $kolor=$split_1[0];
          }
          else
          {
            $kolor="#ffffff";
          }

          echo "<tr id='R-".$a."' style=''>";
          echo "<td><input type=text id='".$NO_REC_ID."' NAME='".$NO_REC_ID."' value='".$row["NO_REC"]."' style='display:none;width:30px;border-width:0px' >".($a+1)."</td>";
          echo "<td><input type=text id='".$TASK_ID."' NAME='".$TASK_ID."' value='".$row["TASK"]."' style='width:300px;border-width:0px;' onchange='update_isi(this.id)' ></td>";
          echo "<td><input type=checkbox id='".$CHECK_ID."' NAME='".$CHECK_ID."' style='width:50px' onchange='update_isi(this.id)' onfocusout='gout(this.id)' ".$checked." ></td>";
          echo "<td style='width:200px;text-align:center' nowrap><input type=text id='".$PROGRESS_ID."' NAME='".$PROGRESS_ID."'  value='".$row["PROGRESS"]."' style='display:none;width:300px' onchange='update_isi(this.id)'><font id='F-".$PROGRESS_ID."' style='margin-right:5px;background:".$kolor."'>".$row["PROGRESS"]."</font>".$SELECTOR."</td><td><img id='hapus-".$a."' src='delete.png' style='cursor:pointer;width:20px' onclick='hapus(this.id)'></td>";
          echo "</tr>";
          $a=$a+1;
          $last_obj=$a;
      }
    }
    for($a=$a;$a<100;$a++)
    {
      $NO_REC_ID="NO_REC-".$a;
      $TASK_ID="TASK-".$a;
      $CHECK_ID="CHECK-".$a;
      $PROGRESS_ID="PROGRESS-".$a;
      
      $SELECTOR=str_replace("XX",$a,$selector);
       if($a>0)
      {
        $dsp="display:none";
      }
      else
      {
        $dsp="";
      }
      echo "<tr id='R-".$a."' style='".$dsp."'>";
      echo "<td><input type=text id='".$NO_REC_ID."' NAME='".$NO_REC_ID."' value='0' style='display:none;width:30px;border-width:0px;' >".($a+1)."</td>";
      echo "<td><input type=text id='".$TASK_ID."' NAME='".$TASK_ID."' style='width:300px;border-width:0px;' onchange='update_isi(this.id)' ></td>";
      echo "<td><input type=checkbox id='".$CHECK_ID."' NAME='".$CHECK_ID."' style='width:50px' onchange='update_isi(this.id)' onfocusout='gout(this.id)' ></td>";
      echo "<td style='width:200px;text-align:center' nowrap><input type=text id='".$PROGRESS_ID."' NAME='".$PROGRESS_ID."' style='display:none;width:300px' onchange='update_isi(this.id)'><font id='F-".$PROGRESS_ID."' style='margin-right:5px'></font>".$SELECTOR."</td><td><img id='hapus-".$a."' src='delete.png' style='cursor:pointer;width:20px' onclick='hapus(this.id)'></td>";
      echo "</tr>";
    }
      echo "</table>";
echo "</td></tr>";
echo "<tr><td><font style='cursor:pointer' onclick='tambah_task()' >+New</font></td></tr>";
echo "</table>";    



?>
</div>
</body>

<script src="jquery.min.js"></script>
<script>
var nomor_obj=<?=$last_obj?>;
var dropdown_list="<?=$dropdown_list?>";

function submit_title()
{
  document.getElementById("title_1").value=document.getElementById("title").value;
  document.getElementById("mytitle").submit();
}


function tambah_task()
{
  var obj_id="R-"+nomor_obj;
  document.getElementById(obj_id).style.display="";
  nomor_obj=nomor_obj+1;
}


function hapus(x)
{
  var id=x.split("-");
  var obj_id=id[1];
  var del=document.getElementById("NO_REC-"+obj_id).value;
  var no_rec=-1*del;
  var task="";
  var check="";
  var user_id=document.getElementById("user_id").value;
  var progress="";
  var title="";
  
  if (confirm("Are you sure tto delete?")) 
  {
      //txt = "You pressed OK!";
  }
   else
  {
      //txt = "You pressed Cancel!";
      return;
  }

  if(del>0)
  {
    sender(obj_id,title,no_rec,user_id,task,check,progress);
  }
  else
  {
    document.getElementById("R-"+obj_id).style.display="none";
  }
}


function dropdown_title(x)
{
  document.getElementById("title").value=document.getElementById(x).value;
}

function dropdown(x)
{
  var id=x.split("-");
  var obj_id=id[1];
  var kolor="#ffffff";
  var selected_value=document.getElementById(x).value;

  document.getElementById("PROGRESS-"+obj_id).value=selected_value
  document.getElementById("F-PROGRESS-"+obj_id).innerHTML=selected_value
  
  var split_1=dropdown_list.split(selected_value+"=");
  //alert(split_1.length)
  if(split_1.length==2)
    {
      split_1=split_1[1].split(";");
      kolor=split_1[0];
    }
    else
    {
      kolor="#ffffff";
    }

  document.getElementById("F-PROGRESS-"+obj_id).style.backgroundColor=kolor;


  var no_rec=document.getElementById("NO_REC-"+obj_id).value;
  var task=document.getElementById("TASK-"+obj_id).value;
  
  var check="";
  if(document.getElementById("CHECK-"+obj_id).checked==true)
  {
    check="done"
  }
  else
  {
    check=""
  }
  var user_id=document.getElementById("user_id").value;
  var title=document.getElementById("title").value;
  var progress=document.getElementById("PROGRESS-"+obj_id).value;
  sender(obj_id,title,no_rec,user_id,task,check,progress);
}

function update_isi(x)
{
  var id=x.split("-");
  var obj_id=id[1];
  var no_rec=document.getElementById("NO_REC-"+obj_id).value;
  var task=document.getElementById("TASK-"+obj_id).value;
  var title=document.getElementById("title").value;
  var check="";
  if(document.getElementById("CHECK-"+obj_id).checked==true)
  {
    check="done"
  }
  else
  {
    check=""
  }
 
  var user_id=document.getElementById("user_id").value;
  var progress=document.getElementById("PROGRESS-"+obj_id).value;
  sender(obj_id,title,no_rec,user_id,task,check,progress);
  
}

function gout(x)
{
  location.reload();
}

function sender(obj_id,title,no_rec,user_id,task,check,progress){

   if(user_id=="")
   {
    return;
   }

 
    $.post("http://localhost/UTS_LAB/todolist.php",
    {
      USER_ID: user_id,
      NO_REC: no_rec,
      TASK: task,
      CHECK: check,
      PROGRESS: progress,
      TITLE: title
    },
    function(data,status){
      //alert("Data: " + data + "\nStatus: " + status);
      var spliter=String.fromCharCode(10);
      var data_array=data.split(spliter);
      var data_id=data_array[1].split("=");
      //alert(data_id[1])
      if(no_rec>=0)
      {
        document.getElementById("NO_REC-"+obj_id).value=data_id[1];
        
      }
      else
      {
        document.getElementById("R-"+obj_id).style.display="none";
      }
      //hasil.innerHTML=data;
    });
  };

  </script>