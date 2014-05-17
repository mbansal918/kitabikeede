<?php ob_start(); ?>
<?php
session_start();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>
<a href="bslogin.php?logout" id="logout">Logout</a>
<h2 style="color:black;">
<?php
if(isset($_SESSION['currentuser'])){
	echo "Kitabi Keede welcomes you.You can add categories and books From here.";
	$bsid = $_GET['id'];
}
else{
	redirect_to("bslogin.php");
}
?>
</h2>
<?php
if(isset($_POST['category'])){
	if(!empty($_POST['category'])){
	$category = $_POST['category'];
	$query = mysql_query("INSERT INTO bscategories (category,bookstoreid) VALUES ('$category','$bsid')");
	if(empty($query)){
		echo "error";
	}
}
}
?>

<?php
$query2 = mysql_query("SELECT * FROM bscategories WHERE bookstoreid='$bsid' ORDER BY Category");
if(empty($query2)){
	echo "error";
}
while($row2 = mysql_fetch_array($query2)){
	$categories[] = $row2['category'];
}
$total = sizeof($categories);
?>
	<form id ="catform" method="POST">
			<input type="text" name="category" id="newcat" placeholder="Category Name">
			<button type="submit">Add this category</button>
	</form>
<h2 style="color:black;">Select a category to add or remove books.</h2>
<div class="catlist">
		<?php
			for($i = 0; $i < $total ; $i++){

		?>
					<div class="notifications">
                    	<div class="notif">
                     		<div class="shine"></div>
                        	<div class="head"><a id="added" href="bsbooks.php?id=<?php echo $bsid ?>&category=<?php echo $categories[$i] ?>"><?php echo $categories[$i] ?></a>
                        		<br /><a href="remove.php?id=<?php echo $bsid ?>&category=<?php echo $categories[$i] ?>" 
                        		id="remove">remove this category</a></div>
                      	</div>
                	</div>
        <?php } ?>
</div>
<?php include("includes/footer.php"); ?>
<?php ob_end_flush(); ?>