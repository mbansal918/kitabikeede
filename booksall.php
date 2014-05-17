<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
$location = mysql_prep($_GET['location']);
$bsid = mysql_prep($_GET['bookstore']);

$query = mysql_query("SELECT * FROM bookstores WHERE md5(id)='$bsid'");
$row = mysql_fetch_array($query);
$storename = $row['bookstorename'];
?>

<h1 id="bsheading"><?php echo $storename ?></h1>
<!--<img src="img/bookseller.jpg" id="bookseller">-->
<br><br>
 
<?php
$query = mysql_query("SELECT * FROM bscategories WHERE bookstoreid='$bsid'");
while($row = mysql_fetch_array($query)){
	$categorynames[] = $row['category'];
	$categoryids[] = $row['id'];
}
$total = sizeof($categorynames);

for($i = 0 ; $i < $total ; $i++){
	echo '<li id="cathead"><strong>List of books added in</strong> '.$categorynames[$i].'</li>';	
	$catname = $categorynames[$i];

	?>
</br>
	<table width="60%">
		<tr >
			<th><h3 id="list" style="padding-left:40px; margin-left:200px;">BookName</h3></th>
			<th><h3 id="list" style="padding-left:100px;">AuthorName</h3></th>
			<th><h3 id="list" style="padding-left:110px;">Edition</h3></th>
			<th><h3 id="list" style="padding-left:100px;">Price(Rs.)</h3></th>
			
		</tr>
	</table>	

	<?php
	$query2 = mysql_query("SELECT * FROM bsbooks WHERE bookstoreid='$bsid' AND categoryname='$catname'");
	while($row = mysql_fetch_array($query2)){
	$booknames = $row['bookname'];
	$editions = $row['edition'];
	$authornames = $row['authorname'];
	$price = $row['price'];
	?>
	
	<!--echo '<li id="bookhead">'.$booknames." By ".$authornames."<strong>&nbsp;&nbsp;&nbsp;of</strong> ".$editions."edition price Rs.".$price.'</li>';
	//	echo '<br>';-->

	<?php	 
		

echo '<table width=60% height=15%  style="margin-left:220px" border="1" style="cellpadding-left:3px;">
		
			<th style="text-align:left" width="250px" height=15% bgcolor=#c0c0c0><h4 style="margin-left:20px;">'.$booknames .'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$authornames.'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="c0c0c0"><h4 style="margin-left:20px;">'.$editions.'</h4></th>
			<th style="text-align:left" width="200px" height=15% bgcolor="ffffff"><h4 style="margin-left:20px;">'.$price.'</h4></th></table><br>	';
		}

}

?><?php include("includes/footer.php"); ?>

