<?php ob_start(); ?>
<?php
session_start();
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>
<?php
$msg = "";

if(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	$msg = "you have successfully logged out";
	session_start();
}
?>
<?php

if(isset($_POST['pass']) && isset($_POST['user'])){
	$uname = $_POST['user'];
	$pword = $_POST['pass'];
	$query = mysql_query("SELECT * FROM bookstores WHERE username = '$uname' AND password='$pword'");
	$row = mysql_fetch_array($query);
	if(empty($row)){
		$msg="wrong username or password";
	}
	else{
	$_SESSION['currentuser'] = $uname;
	$bsid = md5($row['id']);
	redirect_to("bookstore.php?id=$bsid");
	}
}
?>
<div>
<center><h1 style="font-family:cursive;">For BookStore Owners Only</h1></center>
<table id="loginbs">
	<tr>
		<td>
			<form id="bsform" method="post">
			<label class="bsbody">
  				<div class="bsbox">
    				<div class="bscontent">
      					<h1>Authentication Required</h1><br><br>
      						<?php echo $msg ?>
      				<input class="bsfield" type="text" name="user" placeholder="Operative ID"><br>
      				<input class="bsfield" type="password" name="pass" placeholder="Access Code"><br>
      				<input class="bsbtn" type="submit" value="Validate">  
    			</div>
  				</div>
				</label>
			</form>
		</td>
		<td>
					<p id="member">
						<br /><br />Not added your bookstore to the list till.<br/>
						Add it now . Make your BookStore popular.<br /> Help people search you.
						For queries and to <br />add your BookStore mail us at
						kitabikeede@gmail.com<br />
						Id and access code will be provided to you.
					</p>		
		</td>
	</tr>
</table>
</div>
<div id="sign">Kitabi Keede</div>
<?php include("includes/footer.php"); ?>
<?php ob_end_flush(); ?>