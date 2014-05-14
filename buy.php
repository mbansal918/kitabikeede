<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
	$id =$_GET['id'];
	$seller = get_seller_from_id($id);
	$email = get_email_from_id($id);
	$number = get_number_from_id($id);
	$location = get_location_from_id($id);
	$book = get_book_from_id($id);
	$author = get_authorname_from_id($id);
	$edition = get_edition_from_id($id);

	$x=1;
	if(!($query = mysql_query("UPDATE books SET sold=1 WHERE id=$id")))
	{
		echo mysql_error();
	}
	echo "<br /><br /><br /><br />";	
	echo "<div class=\"text\"><strong>The book name is: <em>".$book."</em><br /></strong></div><br />";
	echo "<div class=\"text\"><strong>The author of the <em>".$book."</em> is: <em>".$author."</em><br /></strong></div><br />";
	echo "<div class=\"text\"><strong>The author of the <em>".$book."</em> is: <em>".$edition."</em><br /></strong></div><br />";
	echo "<div class=\"text\"><strong>You can buy this book from: <em>".$seller."</em><br /></strong></div><br />";
	echo "<div class=\"text\"><strong><em>".$seller."</em>'s email id is: <em>".$email."<br /></strong></div><br />";
	echo "<div class=\"text\"><strong>".$seller."</em>'s phone number is: <em>".$number."</em></strong></div><br />";
	echo "<div class=\"text\"><strong>".$seller."</em>'s address is: <em>".$location."</em></strong></div><br />";

?>
<?php include("includes/footer.php"); ?>