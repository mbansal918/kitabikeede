<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$id = $_GET['bookstore'];
$query = mysql_query("SELECT * FROM bookstores WHERE md5(id)='$id'");
$row = mysql_fetch_array($query);
$bsname = $row['bookstorename'];
$location = $row['location'];
$phone = $row['phone'];
$address = $row['address'];
?>

<div id="bsname"><?php echo $bsname ?></div>
<img src="img/bookstoreinfo.jpg" id="bookstimg">
<div id="bsphone">Contact No. - <?php echo $phone ?></div>
<div id="bsaddress">Address - <?php echo $address ?></div>
<div id="bslocation">City - <?php echo $location ?></div>

<?php include("includes/footer.php"); ?>