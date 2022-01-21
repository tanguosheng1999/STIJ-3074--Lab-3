<?php
if (isset($_POST["submit"])) {
    include_once("dbconnect.php");
    $name = $_POST["name"];
    $idno = $_POST["idno"];
    $brand = addslashes ($_POST["brand"]);
    $price = $_POST["price"];
    $description = addslashes ($_POST["description"]);
    $country = $_POST["country"];
    $sqlinsert = "INSERT INTO `tbl_watchs`(`watch_name`, `watch_id`, `watch_brand`, `watch_price`, `watch_desc`, `watch_country`) VALUES ('$name','$idno', '$brand', '$price', '$description', '$country')";
    try {
        $conn->exec($sqlinsert);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            uploadImage($idno);
        }
        echo "<script>alert('Registration successful')</script>";
        echo "<script>window.location.replace('new_watch.php')</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Registration failed')</script>";
        echo "<script>window.location.replace('new_watch.php')</script>";
    }
}

function uploadImage($idno)
{
    $target_dir = "../images/watchs/";
    $target_file = $target_dir . $idno . ".jpg";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html>
<title>TIMESHOP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<script src="../javascript/script.js"></script>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
  <a href="new_watch.php" onclick="w3_close()" class="w3-bar-item w3-button">New Watch</a>
  <a href="index.php#About" onclick="w3_close()" class="w3-bar-item w3-button">About</a>
</nav>

<!-- Top menu -->
<div id="Home" class="Home w3-container w3-text-blue w3-padding-16">
<div class="w3-dispaly-container w3-text-blue">
  <div class=" w3-xlarge" style="max-width:1200px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-right w3-padding-16 w3-hide-large w3-hide-medium"><img src="logo time shop.png" width="80" height="80"></div>
    <div class="w3-center w3-padding-16 w3-hide-large w3-hide-medium" style="font-weight:bold">TIME SHOP</div>
    <div class="w3-right w3-padding-16 w3-hide-small"><img src="logo time shop.png" width="120" height="120"></div>
    <div class="w3-center w3-padding-16 w3-hide-small" style="font-size: 100px; font-weight:bold">TIME SHOP</div>
  </div>
</div>
</div>

<div class="w3-bar w3-blue">
        <a href="index.php" class="w3-bar-item w3-button w3-left">Home</a>
    </div>

<!-- !PAGE CONTENT! -->
<div class="w3-container">
    <br>
    <br>
    <br>
    <form class="w3-container" style="max-width: 800px; margin: auto;" name="registerForm" action="new_watch.php" method="post" onsubmit="return confirmDialog()" enctype="multipart/form-data">
        <div class="w3-container w3-blue">
            <h2 class="w3-center">New Watch</h2>
        </div>
        <div class="w3-container w3-border w3-center w3-padding">
                    <img class="w3-image w3-round w3-margin" src="../images/watchs/default.png" style="height:100%;width:100%;max-width:330px""><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"><br>
                </div>
        <p>
            <label>Watch Name</label>
            <input class="w3-input" name="name" id="idname" type="text" required>
        </p>
        <p>
            <label>Watch ID</label>
            <input class="w3-input" name="idno" id="idid" type="text" required>
        </p>
        <p>
            <label>Watch Brand</label>
            <input class="w3-input" name="brand" id="idbrand" type="text" required>
        </p>
        <p>
            <label>Price</label>
            <input class="w3-input" name="price" id="idprice" type="number" step="any" required>
        </p>
        <p>
            <label>Description</label>
            <textarea class="w3-input w3-border" id="iddesc" name="description" rows="4" cols="50" width="100%" placeholder="Watch Description" required></textarea>
        </p>
        <br>
        <select class="w3-select" name="country" id="idcountry">
            <option value="" disabled selected>Country</option>
            <option value="Japan">Japan</option>
            <option value="Germany">Germany</option>
            <option value="London">London</option>
        </select>
        <br>
        <br>
         <div class="row">
            <input class="w3-input w3-border w3-block w3-blue w3-round" type="submit" name="submit" value="Submit">
        </div>
</form>
</div>

<footer class="w3-row-padding w3-padding-32">
  <hr></hr>
  <p class="w3-center">TimeShop&reg;</p>
</footer>

</body>
</html>
