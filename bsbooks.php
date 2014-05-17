<?php ob_start(); ?>
<?php
session_start();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>
<?php
	$bookstoreid = mysql_prep($_GET['id']);
	$categoryname = mysql_prep($_GET['category']);
?>
<?php
if(isset($_GET['bookname'])){
	$bname = mysql_prep($_GET['bookname']);
	$aname = mysql_prep($_GET['authorname']);
	$ed = mysql_prep($_GET['edition']);
	$query4 = mysql_query("DELETE FROM bsbooks 
	WHERE bookname = '$bname' 
	AND edition = '$ed' 
	AND authorname = '$aname' 
	AND bookstoreid = '$bookstoreid'");
}
?>
<?php
$query3 = mysql_query("SELECT * FROM bsbooks 
	WHERE bookstoreid='$bookstoreid' 
	AND categoryname='$categoryname' 
	ORDER BY bookname");
if(empty($query3)){
	echo "error";
}
while($result = mysql_fetch_array($query3)){
	$booklist[] = $result['bookname'];
	$editionlist[] = $result['edition'];
	$authorlist[] = $result['authorname'];
	$pricelist[] = $result['price'];
}
$totallist = sizeof($booklist);
?>

<?php
if(isset($_POST['bookname']) && isset($_POST['authorname']) && isset($_POST['price'])){
	$bookname = addslashes($_POST['bookname']);
	$authorname = addslashes($_POST['authorname']);
	$edition = addslashes($_POST['edition']);
	$price = addslashes($_POST['price']);
	$query = mysql_query("INSERT INTO bsbooks (bookname,edition,authorname,price,bookstoreid,categoryname) 
				VALUES ('$bookname','$edition','$authorname','$price','$bookstoreid','$categoryname')");
	redirect_to("bsbooks.php?id=$bookstoreid&category=$categoryname");
}

?>
<a href="bslogin.php?logout" id="logout">Logout</a>
<h1 style="color:black;">ADD BOOKS</h1>
<form method="POST">
<input type="text" placeholder="bookname" id="bsb" name="bookname">
<input type="text" placeholder="edition" id="bsb" name="edition">
<input type="text" placeholder="authorname" id="bsb" name="authorname">
<input type="text" placeholder="price" id="bsb" name="price">
<button>Add this book</button>
</form>
<h1 style="color:black; margin-left:45px;">List of Books Already added</h1>
<table>
	<tr>
		<td><h3 style="padding-left:40px;">BookName</h3></td>
		<td><h3 style="padding-left:150px;">Edition</h3></td>
		<td><h3 style="padding-left:100px;">AuthorName</h3></td>
		<td><h3 style="padding-left:100px;">PriceInRupees</h3></td>
		<td><h3 style="padding-left:100px;">Click to remove</h3></td>
	</tr>
</table>

<table id="storetable">
<?php
for($i = 0; $i < $totallist ; $i++){
?>
	<tr>
	<td><label id="booklist" style="margin-left:30px;";><?php echo $booklist[$i]; ?></label><td/>
	<td><label id="booklist" style="margin-left:250px;";><?php echo $editionlist[$i]; ?></label><td/>
	<td><label id="booklist" style="margin-left:380px;";><?php echo $authorlist[$i]; ?></label><td/>
	<td><label id="booklist" style="margin-left:600px;";><?php echo $pricelist[$i]; ?></label><td/>
	<td><label id="booklist" style="margin-left:790px;"><a href="bsbooks.php?id=<?php echo $bookstoreid ?>
		&category=<?php echo $categoryname ?>
		&bookname=<?php echo $booklist[$i] ?>
		&authorname=<?php echo $authorlist[$i] ?>
		&edition=<?php echo $editionlist[$i] ?>
		">remove this book</a></label></td>
	</tr>
<?php }
?>
</table>

<?php include("includes/footer.php"); ?>
<?php ob_end_flush(); ?>