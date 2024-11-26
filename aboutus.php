<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 8px;
}

.about-section {
  padding: 5px;
  text-align: center;
  background-color: #ffffff;
  color: #967E76;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 500px) {
  .column {
    width: 300%;
    display: block;
  }
}
</style>
</head>
<body>

<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="w3.css">


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
  <a href="#" class="w3-bar-item w3-button">About Us</a>
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

<div id="main" style="height:580px;">

<div class="w3-teal" style="background-color:#">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container" style="background-color:#BCA37F">
   
    <h1 style="font-family:garamont">MOMOLIST</h1>
  </div>
</div>

<div class="about-section">
  <h1>ABOUT US</h1>
  <p>Welcome to our 'About Us' page. Here, we would like to introduce ourselves</P>
  <P>and share the story of our journey as a company committed to providing the best service.</p>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="lea.jpeg" alt="Jane" style="width:100%">
      <div class="container">
        <h2>Azalea Keisha</h2>
        <p class="title">Mahasiswa</p>
        <p>Mahasiswa Teknik Informatika di Universitas Multimedia Nusantara</p>
        <p>azalea.keisha@student.umn.ac.id</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="erpa.jpeg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Erva Yanti</h2>
        <p class="title">Mahasiswa</p>
        <p>Mahasiswa Teknik Informatika di Universitas Multimedia Nusantara</p>
        <p>erva.yanti@student.umn.ac.id</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      <img src="tamara.jpeg" alt="John" style="width:100%">
      <div class="container">
        <h2>Tamara Zumaidah</h2>
        <p class="title">Mahasiswa</p>
        <p>Mahasiswa Teknik Informatika di Universitas Multimedia Nusantara</p>
        <p>tamara.zumaidah@student.umn.ac.id</p>
        <p><button class="button">Contact</button></p>
      </div>
    </div>
  </div>
</div>

</body>


</html>