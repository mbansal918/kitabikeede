<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$location = $_GET['location'];
$bookname = $_GET['bookname'];
?>
<?php
if(isset($_POST['search']) && isset($_POST['key'])){
	$bookname = $_POST['key'];
	redirect_to("booksearch.php?location=$location&bookname=$bookname");
}
?>

<form method="POST">
	<input type="text" name="key" value="<?php echo $bookname ?>" id="srh">
	<button type="submit" name="search">Search</button>
</form>
</br>
<h2 style="text-align:center">Search results for the Book</h2>
<table width="60%">
		<tr >
			<th><h3 id="list" style="padding-left:40px; margin-left:150px;">BookName</h3></th>
			<th><h3 id="list" style="padding-left:100px;">AuthorName</h3></th>
			<th><h3 id="list" style="padding-left:110px;">Edition</h3></th>
			<th><h3 id="list" style="padding-left:100px;">Price(Rs.)</h3></th>
			<th><h3 id="list" style="padding-left:100px;">Available at</h3></th>
			
		</tr>
	</table>
<?php
$query2 = mysql_query("SELECT * FROM bookstores WHERE location='$location'");
while($row=mysql_fetch_array($query2)){
	$bookstoreid[] = md5($row['id']);
}

for($i = 0 ; $i< sizeof($bookstoreid) ; $i++){
$query=mysql_query("SELECT * FROM bsbooks WHERE bookname LIKE '%$bookname%' AND bookstoreid='$bookstoreid[$i]'");

while($res = mysql_fetch_array($query)){
	$books[] = $res['bookname'];
	$bookid[] = $res['id'];
}
}

for($i=0 ; $i<sizeof($bookid) ; $i++){
	$query=mysql_query("SELECT * FROM bsbooks WHERE id='$bookid[$i]'");
	$result = mysql_fetch_array($query);
	$bookst = $result['bookstoreid'];
	if(empty($result)){
		echo "error";
	}
	$query=mysql_query("SELECT * FROM bookstores WHERE md5(id)='$bookst'");
	$re = mysql_fetch_array($query);
	$bstoreid = md5($re['id']); 

echo '<table width=80% height=15%  style="margin-left:150px" border="1" style="cellpadding-left:3px;">
		
			<th style="text-align:left" width="300px" height=15% bgcolor=#c0c0c0><h4 style="margin-left:20px;">'.$result['bookname'].'</h4></th>
			<th style="text-align:left" width="300px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$result['authorname'].'</h4></th>
			<th style="text-align:left" width="300px" height=15% bgcolor="c0c0c0"><h4 style="margin-left:20px;">'.$result['edition'].'</h4></th>
			<th style="text-align:left" width="300px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$result['price'].'</h4></th>
            <th style="text-align:left" width="300px" height=15% bgcolor="c0c0c0"><h4 style="margin-left:20px;">'.
            "<a href=\"bookstoreinfo.php?bookstore=$bstoreid\" id=\"bsdetails\">".$re['bookstorename'].'</a></h4></th>
			</table><br>';

	
	
	?>
	
	</li>
	<br>
	<?php
}
?>

<div style="text-align:center;">
<?php
echo "No more Books to display";
?>
</div>
<?php include("includes/footer.php"); ?>