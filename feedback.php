<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>


<?php
if(isset($_POST['fback'])){
	$f = $_POST['fback'] ;
	$query = mysql_query("INSERT INTO feedbacks VALUES ('', '$f')");
}
?>

<div id="fb">
<form action="feedback.php" method="POST">
	<div id="note">
		<h1>Feedback and Suggestions</h1>
		<textarea id="suggestion" name="fback"></textarea>
	</div>
		<input type="submit" id="suggest">
</form>
</div>

<?php include("includes/footer.php"); ?>