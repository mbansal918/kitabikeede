<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>


<?php
	if(isset($_POST['submit']))
	{
		$submit = mysql_prep(strip_tags($_POST['submit']));
		$college = mysql_prep(strip_tags($_POST['college']));
			if(!empty($college))
			{
				$query2 = mysql_query("SELECT * FROM colleges WHERE college='$college'");
				$ror = mysql_fetch_array($query2);
				if(empty($ror)){
				$query = mysql_query("INSERT INTO colleges VALUES ('','$college')");
				redirect_to("buyfrom.php");
			}
			}
	}
?>
<div class="buybody">
	<div id="buyoptions">
		<h3 id="buytext">Look for a book within your college.</br>
			OR sell a book to your collegemates.<br/>
			Sell and Buy 2nd hand books.
		</h3>
		<a href="#mymodal" class="button" id="buybutton" data-toggle="modal">
			<span class="shine"></span>
			<span class="text">Search / Submit a book by your college / School</span>
		</a>

		<h3 id="buytext">Look for a book at bookstores at </br> your location.
			You can also add your <br/> bookstore to the list.	
		</h3>

		<a href="#secondmodal" id="buybutton" class="button" data-toggle="modal">
			<span class="shine"></span>
			<span class="text">Buy a book from a book-store in your location</span>
		</a>
		<h2 id="kk">Kitabikeede happy to help you. </h2>
	</div>
</div>



<div class="modal hide fade" id="mymodal" aria-hidden="true">
	<div class="modal-header">
		<h1>Choose a College / School</h1>
	</div>
	<div class="modal-body">
		<form action="collegepage.php?name="<?php if(isset($record['college'])) 
												echo urlencode($record['college']);?>"
												" >
			<select name="name" id="collegelist">
				<?php 
					$mydata = mysql_query("SELECT DISTINCT(college) FROM colleges ORDER BY college");
					while ($record = mysql_fetch_array($mydata)) 
					{
						echo '<option id="ox" value="'.$record['college']. '">'.$record['college'].'</option>';
					}
				 ?>
			</select>

		

			<div class="modal-header">
				<h1>Choose a category</h1>
			</div>
			<select name="category" id="collegelist">
				<?php 
					$data = mysql_query("SELECT * FROM categories");
					while ($rcrd = mysql_fetch_array($data)) 
					{
						echo '<option id="ox" value="'.$rcrd['category']. '">'.$rcrd['category'].'</option>';
					}
				 ?>
			</select><br />
			<button type="submit" name="Go" value="submit" class="btn btn-primary">Buy or Sell Book</button>
		</form>

		<div id="form" class="well">
			<form action="buyfrom.php" method="POST">
				Not found your college in the list.</br>
				Add a College / School : <input type="text" name="college"> <br>
				<button type="submit" name="submit" class="btn btn-primary">Add College / School</button>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
			</form>
		</div>
	</div>
</div>


<div class="modal hide fade" id="secondmodal" aria-hidden="true">
	<div class="modal-header">
		<h3>Choose a location</h3>
	</div>
	<div class="modal-body">
		<form action="dukaan.php?name="<?php if(isset($record['location'])) 
												echo urlencode($record['location']);?>"
												" >
			<select name="locations" id="collegelist">
				<?php 
					$mydata = mysql_query("SELECT DISTINCT(location) FROM bookstores");
					while ($record = mysql_fetch_array($mydata)) 
					{
						echo '<option>'.$record['location'].'</option>';
					}
				 ?>
			</select>
			<br />
			<br />
			<br />
			<button type="submit" class="btn btn-primary">Submit</button>
			<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		</form>
		<br />
	</div>

	<div class="modal-footer">

	</div>
</div>


<img src="img/buy.jpg" id="buyimage">
</div>
<?php include("includes/footer.php"); ?>