<?php
session_start();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$bsid = $_GET['id'];
$catname = $_GET['category'];
?>
<?php
if(isset($_POST['yes'])){
	$query = mysql_query("DELETE FROM bscategories WHERE bookstoreid='$bsid' AND category='$catname'");
	redirect_to("bookstore.php?id=$bsid");
}

elseif(isset($_POST['cancel'])){
	redirect_to("bookstore.php?id=$bsid");
}
?>


Are you sure you want to remove this category ?
<br />
yes to delete this category permanently.
<br />
cancel to go back.
<br />
<form method="POST">
<button type="submit" name="yes">yes</button>
<button type="submit" name="cancel">cancel</button>
</form>
<?php include("includes/footer.php"); ?>