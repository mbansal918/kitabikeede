<?php ob_start();?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$location = $_GET['locations'];
if(isset($_POST['booksearch'])){
	$bookname=$_POST['bookname'];
	redirect_to("booksearch.php?location=$location&bookname=$bookname");
}

?>

<?php
$location = $_GET['locations'];
if(isset($_POST['categorysearch'])){
	$categoryname=$_POST['categoryname'];
	redirect_to("categorysearch.php?location=$location&category=$categoryname");
}

?>

<form method="POST">
<h3 id="srch">Search for a Book among these BookStores</h3><div id="srch">Enter the BookName
<input type="text" id="search" name="bookname">
<button type="submit" name="booksearch">search</button></div>
<h3 id="srch">Search for a Category among these BookStores</h3><div id="srch">Enter the CategoryName
<input type="text" id="search" name="categoryname">
<button type="submit" name="categorysearch">search</button> </div>
</form>
<br />
<h2 style="text-align:center;">BookStores at your Location</h2>
<h4 style="text-align:center;">Select a BookStore to see available Books</h4>
<?php
	$location = $_GET['locations'];
	if(isset($location))
	{
		$query = mysql_query("SELECT * FROM bookstores WHERE location='$location'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		echo "<div class=\"catalyst\">";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{ 
			?>
				<div class="searchbody">
					<a href="booksall.php?location=<?php echo urlencode($location) ?>&bookstore=<?php 
						echo urlencode(md5($row['id'])) ;?>" class="button">
						<span class="shine"></span>
						<span class="text"><?php echo $row['bookstorename'];?></span>
					</a>
				</div>
			<?php
			}
			echo "</div>";
		}
	}
?>

<?php include("includes/footer.php"); ?>
<?php ob_end_flush();?>
