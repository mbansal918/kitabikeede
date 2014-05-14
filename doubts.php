	<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>


<?php
		$topic = NULL;
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
			$query = mysql_query("INSERT INTO topics (topic,subject_id) VALUES ('$topic',$id)");
		}
	?>

	
<div id="card" style="margin-top:20px;">
	<form action='doubts.php?id=<?php echo urlencode($id);?>' method="POST">
		  <h2>Add a topic</h2>
		  <input type="text" style="height:40px;" id="name" name="topic" placeholder="Topic.."/>
      <br />
      <input type="submit" name="submit" class="doubtbutton">
	</form>
</div>

<div style="margin-left:800px; color:black;"><h1>Choose a topic</h1></div>
<br />

<?php 	
	echo "<div id=\"forum\" style=\"margin-left:650px;\">
			<ul>
			  <li>";
			  $query = mysql_query("SELECT * FROM topics WHERE subject_id=$id");
			  $numrows = mysql_num_rows($query);
			  if($numrows!=0)
			  {
			  	while($row = mysql_fetch_assoc($query))
			  	{	
			  	
			  		$topic_id = $row['id'];
					echo "<input type=\"checkbox\" class=\"styled\" id=\"b_1\">
						<a href=\"bar.php?id=".$topic_id."&subject=".$id."\"><label class=\"styled\">".$row['topic']."</label></a>";
				}
			  } 
				echo "</li>
			</ul>
		</div>";
?>


<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>


<script class="cssdeck" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

	<!-- jQuery -->
	<script>
		$(document).ready(function(){
   setInterval(function() {
$("input[type=text]").each(function() {
   var element = $(this);
   if (element.val() !== "") {
     $(this).css({
       boxShadow: 'inset 8px 0px 0  #2ecc71',
       paddingLeft: '12px'})
   }
   var element = $(this);
   if (element.val() == "") {
       $(this).css('border-left', '1px solid #ccc')
   }
});  
}, 200);
});  
	</script>

<?php include("includes/footer.php"); ?>



