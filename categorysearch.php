<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$categoryname = $_GET['category'];
$location = $_GET['location'];
?>

<?php
if(isset($_POST['search']) && isset($_POST['key'])){
	$categoryname = $_POST['key'];
	redirect_to("categorysearch.php?location=$location&category=$categoryname");
}
?>

<form method="POST">
	<input type="text" name="key" value="<?php echo $categoryname ?>" id="srh">
	<button type="submit" name="search">Search</button>
</form>

<?php
$query2 = mysql_query("SELECT * FROM bookstores WHERE location='$location'");
while($row=mysql_fetch_array($query2)){
	$bookstoreid[] = md5($row['id']);
}

for($i = 0 ; $i< sizeof($bookstoreid) ; $i++){
$query=mysql_query("SELECT * FROM bscategories WHERE category LIKE '%$categoryname%' 
		AND bookstoreid='$bookstoreid[$i]'");
while($res = mysql_fetch_array($query)){
	$categories[] = $res['category'];
	$categoryid[] = $res['id'];
}
}
?>
<h1 style="text-align:center;">Categories available at BookStores</h1>
<br>

<?php
for($i = 0; $i < sizeof($categoryid) ; $i++){
	$query=mysql_query("SELECT * FROM bscategories WHERE id='$categoryid[$i]'");
	$row = mysql_fetch_array($query);
	
	$bsid = $row['bookstoreid'];
	$name = $row['category'];
	$query=mysql_query("SELECT * FROM bookstores WHERE md5(id)='$bsid'");
	$row = mysql_fetch_array($query);
	$bstoreid = md5($row['id']);
	
	?><li>
	<h3 id="atext">Books Available under <?php echo $name ;?> at  <?php echo $row['bookstorename'];?>
<a id="bsdetails" href="bookstoreinfo.php?bookstore=<?php echo $bstoreid?> ">&nbsp;&nbsp;&nbsp;View BookStore Details</a>
	</h3>
	</li>
	<table>
		<tr >
			<th><h3 id="list" style="padding-left:40px; margin-left:200px;">BookName</h3></th>
			<th><h3 id="list" style="padding-left:100px;">AuthorName</h3></th>
			<th><h3 id="list" style="padding-left:110px; ">Edition</h3></th>
			<th><h3 id="list" style="padding-left:100px; ">Price(Rs.)</h3></th>
			
		</tr>
	</table>
	<?php
	$query=mysql_query("SELECT * FROM bsbooks WHERE categoryname LIKE '$name' AND bookstoreid='$bsid'");
	while($row = mysql_fetch_array($query)){
		echo '<table height=15%  style="margin-left:220px" border="1" style="cellpadding-left:3px;">
		
			<th style="text-align:left" width="250px" height=15% bgcolor=#c0c0c0><h4 style="margin-left:20px;">'.$row['bookname'].'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$row['authorname'].'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="c0c0c0"><h4 style="margin-left:20px;">'.$row['edition'].'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$row['price'].'</h4></th></table><br>	';






		
		?>
		<?php
	}
}
?>
<?php include("includes/footer.php"); ?>