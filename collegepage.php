<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>	

<?php
	if(isset($_GET['name']) && isset($_GET['category']))
	{	
		$college_name = mysql_prep($_GET['name']);
		$category = mysql_prep($_GET['category']);	
	}
?>
<div id="cpage">
<a href="addbook.php?name=<?php echo urlencode($college_name);?>&category=<?php echo urlencode($category);?>">&nbsp;
		<h3 id="addbook">Add a book to this college and category</h3></a>
		<h2>Books available for this college and Category</h2>
</div>
<?php
	if(isset($college_name))
	{
		$college_id = get_college_id($college_name);
		$category_id = get_category_id($category);
		$query = mysql_query("SELECT * FROM books WHERE college_name = '$college_name' AND category_id=$category_id");
		$numrows = mysql_num_rows($query);
		if($numrows!=0)
		{
?>
		<div id="rule">
		    <ul id="ofthumb">
<?php
				while ($row = mysql_fetch_assoc($query))
				{ 

?>
		        	<li id="righthand">
<?php
				echo "<div class=\"text\"><strong>".$row['bookname']."</strong></div>";
					//echo $row['authorname']."<br />";
				echo "<div class=\"text\"><strong>Edition: ".$row['edition']."</strong></div>";
				echo "<div class=\"text\"><strong>Author: ".$row['authorname']."</strong></div>";
				$book = $row['bookname'];
				$author = $row['authorname'];
				$edition = $row['edition'];
				$seller = $row['seller'];
				$number = $row['phone'];
				$email = $row['email'];
				$id = get_book_id($college_name,$category_id,$book,$author,$edition);
				if($row['image']==null)
				{
 					echo "<img src=\"img/noimage.jpg\" id=\"fucked\">";	
				}
				else
				{
 					echo "<img src=\"get.php?id=$id\" id=\"fucked\">";
				}
				echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a class=\"btn btn-primary\" href=\"buy.php?id=$id\">Click To Buy</a>";

?>
		        	</li>
<?php
		        }
?>
		    </ul>
		</div>
<?php
		}

	}
?>

<?php include("includes/footer.php"); ?>

