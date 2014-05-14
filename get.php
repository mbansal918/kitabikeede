<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	$book_id = $_GET['id'];
	//echo $book_id;
	$image =  mysql_query("SELECT * FROM books WHERE id = $book_id");
	$image = mysql_fetch_assoc($image);
	$image = $image['image'];
	header("Content-type:image/jpeg");
	echo $image;
?>