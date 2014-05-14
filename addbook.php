<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>	

<?php
		//did not understand this code but somehow it solved problem for me for uploading an image
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		if(isset($_FILES["file"]["name"]) && isset($_FILES["file"]["type"]) && $_FILES["file"]['size'])
		{	
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file"]["error"] > 0)
			  {
			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
			  }
			  else
			  {
			    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			    echo "Type: " . $_FILES["file"]["type"] . "<br>";
			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			    echo "Stored in: " . $_FILES["file"]["tmp_name"];
			  }
			}
			else
			  {
			  echo "Invalid file";
			  }
		}
?>
<?php
	if(isset($_GET['name']) && isset($_GET['category']))
	{
		$x=0;
		//echo $_GET['name'];
		//echo $_GET['category'];
		$college_name = mysql_prep($_GET['name']);
		$category = mysql_prep($_GET['category']);
		$college_id = get_college_id($college_name);
		$category_id = get_category_id($category);
		//echo $college_name;
		//echo $category_id;	
		//echo $college_id;
		//echo $category_id;
	}
?>
<?php
	if(isset($_POST['submit']) && isset($_GET['name']))
	{
		$bookname = mysql_prep(strip_tags($_POST['bookname'])); //strip tags is used to delete all the html and php tags from the data
		$authorname = mysql_prep(strip_tags($_POST['authorname']));
		$edition = mysql_prep(strip_tags($_POST['edition']));
		$price = mysql_prep(strip_tags($_POST['price']));
		$name = mysql_prep(strip_tags($_POST['name']));	//md5 value for two similar string is same
		$number = mysql_prep(strip_tags($_POST['number']));
		$email = mysql_prep(strip_tags($_POST['email']));
		$location = mysql_prep(strip_tags($_POST['location']));
		if(isset($_FILES['image']['tmp_name']))
		{
			//echo "hello world";
			$file = $_FILES['image']['tmp_name'];
		}
		$false=0;
		if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Not a valid email address</div>";
			$false = 1;
		}
		else if($bookname == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Bookname not provided</div>";
			$false =1;	
		}
		else if($authorname == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">authorname not provided</div>";
			$false =1;	
		}
		else if($edition == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Edition not filled</div>";
			$false =1;	
		}
		else if($price == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Price not set</div>";
			$false =1;	
		}
		else if($name == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Seller name not provided</div>";
			$false =1;	
		}
		else if($number == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Phone number not provided</div>";
			$false =1;	
		}
		else if($location == NULL)
		{
			echo "<br /><br /><br /><br /><div class=\"text\">Provide a valid address</div>";
			$false =1;	
		}
		if($file==null && $false==0)
		{
			//echo "hello world";
			//echo "<div class=\"text\">hello</div>";
			$insert = mysql_query("INSERT INTO books VALUES('','$bookname','$authorname','$edition',
						'$price','','$name','$number','$email','$location','$college_name','$category_id','')");	
			$x=1;
		}
		if($file!=null && $false==0)
		{
			//echo "hello";
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);	
			if($image_size==FALSE)
			{
				echo "that's not an image";
			}
			else
			{
				//echo $category;
				//echo "hello world";
				if(isset($college_name))
				{
					//echo "hello world";
					//echo $category_id;
					//echo "hello world";
					if(!$insert = mysql_query("INSERT INTO books VALUES('','$bookname','$authorname','$edition',
						'$price','$image','$name','$number','$email','$location','$college_name','$category_id','')"))
					{
						echo "Problem uploading image";
					}
					else
					{
						$x=1;
					}
				}
			}
		}
	}
?>
<?php
	if(isset($college_name))
	{
		//echo $x;
		if($x==1)
		{
			$college_id = get_college_id($college_name);
			$category_id = get_category_id($category);
			
			//echo "hello world";
			//redirect_to("collegepage.php",$college_name,$category);
			$college_name=urlencode($college_name);
			$category=urlencode($category);
			echo "<ul class=\"nav nav-tabs\">
				<li><a href=\"collegepage.php?name=$college_name&category=$category\">&nbsp;Go to college page with same category</a></li>
			</ul>";
		}
	}

?>

<br /><br />
<form action='addbook.php?name=<?php echo urlencode($college_name);?>&category=<?php echo urlencode($category);?>' method="POST" enctype="multipart/form-data">
		<table class="formbook" id = "tab">
			<tr>
				<td>
					<h1 style="color:black">Book Information</h1><br />
					<div style="color:black">Book Name : 
					<input type="text" name="bookname" class="span3" ><br /><br /></div>
					<div style="color:black">Author Name :
					<input type="text" name="authorname" class="span3"> <br /><br /></div>
					<div style="color:black">Edition :
					<input type="text" name="edition" class="span3"> <br /><br /></div>
					<div style="color:black">Price :
					<input type="text" name="price" class="span3"> <br /><br /></div>
					
				</td>
				<td>
					<h1 style="color:black">Seller's Information</h1><br />
					<div style="color:black">Name :
					<input type="text" name="name" class="span3"><br /><br /></div>
					<div style="color:black">Phone number : 
					<input type="text" name="number" class="span3"><br /><br /></div>
					<div style="color:black">Email :
					<input type="text" name="email" class="span3"><br /><br /></div>
					<div style="color:black">Address :
					<input type="text" name="location" class="span3"><br /><br /></div>
			</td>
		</tr>
		</table>
		<div class="formbook">
		<div style="color:black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Image : <br /><br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;			<input type="file" name="image"></div>
					<br /><br />
		</div>
		<!--<input type="submit" name="submit" value="Add Book"/>-->
		<button type="submit" name="submit" value="Add Book" class="btn btn-primary">Add Book</button>
		<button class="btn" formaction="collegepage.php?name=<?php echo $college_name;?>&category=<?php echo $category;?>">College Page</button>
</form>	
<?php include("includes/footer.php"); ?>

