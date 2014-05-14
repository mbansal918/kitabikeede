<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<?php
	$topic = NULL;
	if(isset($_GET['subject']))
	{
		$subject_id = $_GET['subject'];
		//echo $subject_id;
	}
	if(isset($_GET['id']))
	{
		$id =  $_GET['id'];
		//echo $id;
	}
	if(isset($_POST['topic']))
	{
		$topic =  $_POST['topic'];
	}
	if(!is_null($id) && $topic!=NULL)
	{
		$query = mysql_query("INSERT INTO recommends (book_name,topic_id,subject_id) VALUES ('$topic',$id,$subject_id)");
	}

?>
	
<div id="card" style="margin-top:20px;">
	<form action='bar.php?id=<?php echo urlencode($id);?>&subject=<?php echo urlencode($subject_id);?>' method="POST">
		  <h2>Add a book</h2>
		  <input type="text" style="height:40px;" id="name" name="topic" placeholder="Topic.."/>
      <br />
      <input type="submit" name="submit" class="doubtbutton">
	</form>
</div>

<div style="margin-left:800px; margin-top:-150px; color:black;"><h1>Books Recommended</h1>
<strong style="font-size:20px;">
<?php 
		$x=1;
		$query = mysql_query("SELECT * FROM recommends WHERE topic_id = $id AND subject_id=$subject_id");
		$numrows = mysql_num_rows($query);
		//echo $numrows;
		if($numrows!=0)
		{
			while($row = mysql_fetch_assoc($query))
			{
				echo $row['book_name']."<br />";
				$book = $row['book_name'];
?>
				<a href="sum.php?id=<?php echo urlencode($id);?>&subject=<?php echo urlencode($subject_id)?>&book=<?php echo urlencode($row['book_name'])?>" class="plus" id='<?php echo $x; ?>' onclick="newcard(id)">+
<?php 
					if(!($queryz = mysql_query("SELECT * FROM recommends WHERE (book_name='$book')")))
					{
						echo mysql_error();
					}
					$numrows3 = mysql_num_rows($queryz);
					if($numrows3!=0)
					{ 
						while($row2=mysql_fetch_assoc($queryz))
						{
							echo $row2['upvote'];
						}
					}
?>
				</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="sub.php?id=<?php echo urlencode($id);?>&subject=<?php echo urlencode($subject_id)?>&book=<?php echo urlencode($row['book_name'])?>" class="minus">-
<?php 
					if(!($queryzz = mysql_query("SELECT * FROM recommends WHERE (book_name='$book')")))
					{
						echo mysql_error();
					}
					$numrows4 = mysql_num_rows($queryz);
					if($numrows4!=0)
					{ 
						while($row3=mysql_fetch_assoc($queryzz))
						{
							echo $row3['downvote'];
						}
					}
?>
				</a><br /><br />
<?php
				$x++;
			}
		}
?>
</strong>
</div>
<br />


<?php include("includes/footer.php"); ?>