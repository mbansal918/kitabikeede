<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>


<?php
	if(isset($_GET['id']) && isset($_GET['subject']))
	{
		$id = mysql_prep($_GET['id']);
		$subject_id = mysql_prep($_GET['subject']);
		$book = mysql_prep($_GET['book']);
		if(!($query = mysql_query("SELECT * FROM recommends WHERE (topic_id=$id AND subject_id = $subject_id)")))
		{	
			echo mysql_error();
		}
		$numrows = mysql_num_rows($query);
		if($numrows!=0)
		{ 
			while($row=mysql_fetch_assoc($query))
			{
				if($book == $row['book_name'])
				{
					$upvote = $row['upvote'];
					$upvote++;
					$query2 = mysql_query("UPDATE recommends SET upvote = '$upvote' WHERE book_name = '$book'");
				}
				//echo $upvote;
			}
		}
	}
	echo "<div class=\"text\" style=\"margin-top:100px;\">You Have Voted for this book <a href=\"bar.php?id=$id&subject=$subject_id\">Go Back</a></div>";
	
?>


<?php include("includes/footer.php"); ?>