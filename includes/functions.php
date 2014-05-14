<?php

	//Use it as a standard function
	function mysql_prep($value)
	{
		$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");
		if($new_enough_php)
		{
			if($magic_quote_active)
			{
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}
		else
		{
			if(!$magic_quote_active)
			{
				$value=addslashes($value);
			}
		}
		return $value;
	}



	//function to redirect to a page
	function redirect_to($location)
	{
		if($location)
		{
			header("Location: {$location}");
			exit;
		}
	}
	// This file is place to store all basic functions
	function confirm_query($result_set)
	{
		if(!$result_set)
		{
			die("Database query failed ".mysql_error());
		}
	}

	function dropdown()
	{
		$mydata = mysql_query("SELECT * FROM colleges");
		while ($record = mysql_fetch_array($mydata)) 
		{
			echo '<option value="'.$record['college']. '">'.$record['college'].'</option>';
		}
	}

	function display_errors($errors)
	{
		if(!empty($errors))
		{
			echo "<p class=\"errors\">";
			echo "please review the following errors <br />";
			foreach ($errors as $error) {
				# code...
				echo "-" . $error . "<br />";
			}
			echo "</p>";
		}
	}

	function get_book_id_by_bookname($bookname,$authorname)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM colleges WHERE (bookname = '$bookname' AND authorname='$authorname')");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		if(isset($id))
		{
			return $id;
		}
	}

	function get_questions()
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM questions");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				echo $row['question']."<br />";
			}
		}
	}

	function get_number_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$number = $row['phone'];
			}
		}
		if(isset($number))
		{
			return $number;
		}
	}

	function get_book_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$book = $row['bookname'];
			}
		}
		if(isset($book))
		{
			return $book;
		}
	}

	function get_email_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$email = $row['email'];
			}
		}
		if(isset($email))
		{
			return $email;
		}
	}

	function get_authorname_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$authorname = $row['authorname'];
			}
		}
		if(isset($authorname))
		{
			return $authorname;
		}
	}

	function get_edition_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$edition = $row['edition'];
			}
		}
		if(isset($edition))
		{
			return $edition;
		}
	}

	function get_seller_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$seller = $row['seller'];
			}
		}
		if(isset($seller))
		{
			return $seller;
		}
	}

	function get_location_from_id($id)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM books WHERE id = '$id'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$location = $row['location'];
			}
		}
		if(isset($location))
		{
			return $location;
		}
	}

	function get_college_id($college_name)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM colleges WHERE college = '$college_name'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		if(isset($id))
		{
			return $id;
		}
	}

	function get_book_id($college_name,$category_id,$bookname,$authorname,$edition)
	{
		//echo $college_name;
		if(!($query = mysql_query("SELECT * FROM books WHERE (college_name = '$college_name' AND 
									category_id = $category_id AND bookname = '$bookname' AND 
									authorname = '$authorname' AND edition = '$edition')")))
		{
			echo mysql_error();
		}
		$numrows = mysql_num_rows($query);
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		if(isset($id))
		{
			return $id;
		}
	}

	function get_category_id($category)
	{
		//echo $college_name;
		$query = mysql_query("SELECT * FROM categories WHERE category = '$category'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		//echo "hello world";
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		if(isset($id))
		{
			return $id;
		}
	}

	
?>