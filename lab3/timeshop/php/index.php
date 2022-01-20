<?php
$results_per_page = 5;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}

include_once("dbconnect.php");

$sqlquery = "SELECT * FROM tbl_watchs ORDER BY watch_date DESC";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlquery = $sqlquery . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlquery);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<title>TIMESHOP</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../style/style.css">
<script src="../javascript/script.js"></script>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
  <a href="new_watch.php" onclick="w3_close()" class="w3-bar-item w3-button">New Watch</a>
  <a href="#About" onclick="w3_close()" class="w3-bar-item w3-button">About</a>
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
        <a href="new_watch.php" class="w3-bar-item w3-button w3-right">New Product</a>
    </div>

<!-- !PAGE CONTENT! -->
<div id="page" class="page w3-main w3-content w3-padding" style="max-with:1800px; margin-top:100px">
    <div class="w3-grid-template">
        <?php
            foreach ($rows as $watchs){
                $watch_name = $watchs['watch_name'];
                $watch_id = $watchs['watch_id'];
                $watch_brand = $watchs['watch_brand'];
                $watch_price = $watchs['watch_price'];
                $watch_desc = $watchs['watch_desc'];
                $watch_country = $watchs['watch_country'];
                $watch_date = $watchs['watch_date'];
                
                echo "<div class='w3-center w3-padding'><div class='w3-card-4 w3-round-medium'>
                <header class='w3-blue w3-center'>
                <h5>$watch_name</h5></header>
                <div class='w3-padding'><img class='w3-image' src=../images/watchs/$watch_id.jpg onerror=this.onerror=null;this.src='../images/watchs/default.png'></div>
                <hr>
                <p><i class='fa fa-id-card' style='font-size:16px'></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$watch_brand<br>
                <i class='fa fa-money' style='font-size:16px'></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspRM$watch_price<br>
                <i class='fa fa-flag' style='font-size:16px'></i>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp$watch_country</p>
                <p><div class='w3-container'><a href='#' class='w3-btn w3-blue w3-round'>Details</a></div></p>
                <br>
                </div></div>";
            }
        ?>
    </div>
</div>

<?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + $results_per_page;
    } else {
        $num = $pageno * $results_per_page - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "index.php?pageno=' . $page . '" style=
        "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    
<div id="About" class="About w3-container w3-text-black w3-center">
<h1 style="font-size:calc(20px + 2vw);">DEVELOPER OF Time Shop</h1>
<br>
<br>
<img class="p1" src="me.jpeg" alt="Avatar" style="width:180px">
<p style="font-weight: bold;">Tan Guo Sheng</p>
<p>guosheng0000@gmail.com</p>
<p>Developer of PEPELIST</p>
<p>Undergraduate Student in UUM</p>
<a href="https://github.com/tanguosheng1999" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-github w3-xxlarge"></i></a>
<a href="https://www.facebook.com/profile.php?id=100003840633146" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-facebook w3-xxlarge"></i></a>
<a href="https://www.instagram.com/tgs_0317/" class="w3-button w3-hover-none w3-hover-border-black"><i class="fa fa-instagram w3-xxlarge"></i></a>
</div>

<footer class="w3-row-padding w3-padding-32">
  <hr></hr>
  <p class="w3-center">TimeShop&reg;</p>
</footer>

</body>
</html>
