<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/constants.php"); ?>
<?php include("includes/header.php"); ?>

<!--
<div id="slideshow-wrap">
        <input type="radio" id="button-1" name="controls" checked="checked"/>
        <label for="button-1"></label>
        <input type="radio" id="button-2" name="controls"/>
        <label for="button-2"></label>
        <input type="radio" id="button-3" name="controls"/>
        <label for="button-3"></label>
        <input type="radio" id="button-4" name="controls"/>
        <label for="button-4"></label>
        <input type="radio" id="button-5" name="controls"/>
        <label for="button-5"></label>
        <label for="button-1" class="arrows" id="arrow-1">></label>
        <label for="button-2" class="arrows" id="arrow-2">></label>
        <label for="button-3" class="arrows" id="arrow-3">></label>
        <label for="button-4" class="arrows" id="arrow-4">></label>
        <label for="button-5" class="arrows" id="arrow-5">></label>
        <div id="slideshow-inner">
            <ul>
                <li id="slide1">
                    <img src="img/book1.jpg" />
                    
                </li>
                <li id="slide2">
                    <img src="img/book2.jpg" />
                    
                </li>
                <li id="slide3">
                    <img src="img/book3.jpg" />
                    
                </li>
                <li id="slide4">
                    <img src="img/book4.jpg" />
                    
                </li>
                <li id="slide5">
                    <img src="img/book5.jpg" />
                </li>
            </ul>
        </div>
    </div>
  -->
<?php
$query = mysql_query("SELECT * FROM colleges WHERE visible=1");
    while($row = mysql_fetch_array($query))
    $not[] = $row['college'];
$colleges = sizeof($not);
?>


  <!-- slider 2 -->
  <p id="tag">Where the bookstore comes to you.</p>

            <table id="sltable" >
              <tr>
                <td style="padding:0 0 0 250px";>
                  <div id="slider">
                  <img id="one" src="img/book1.jpg" />
                  <img id="two" src="img/book3.jpg" />
                  <img id="three" src="img/book5.jpg" />
                  <img id="four" src="img/book4.jpg" />
                  <img id="five" src="img/book2.jpg" />
                  <ul>
                    <li>
                      <a href="#one"></a>
                    </li>
                    <li>
                      <a href="#two"></a>
                    </li>
                    <li>
                      <a href="#three"></a>
                    </li>
                    <li>
                      <a href="#four"></a>
                    </li>
                    <li>
                      <a href="#five"></a>
                    </li>
                  </ul>
                  </div>
                </td>
                <td style="padding-left:100px;">
                  <div class="notifications">
                    <div class="notif">
                      <div class="shine"></div>
                        <div class="head"><?php echo $not[$colleges-1] ?></div>
                          <div class="ntext">
                          was added to the college list
                          </div>
                      </div>
                    </div>
                  <div class="notifications">
                    <div class="notif">
                      <div class="shine"></div>
                        <div class="head"><?php echo $not[$colleges - 2] ?></div>
                          <div class="ntext">was added to the college list
                          </div>
                      </div>
                    </div>
                  <div class="notifications">
                    <div class="notif">
                      <div class="shine"></div>
                        <div class="head"><?php echo $not[$colleges - 3] ?></div>
                          <div class="ntext">
                          was added to the college list
                          </div>
                      </div>
                    </div>
                </td>
              </tr>
            </table>


<?php
	if(isset($_POST['college']))
	{
		$var = $_POST['college'];
		echo "
			<html>
				<a href=\"collegepage.php?name=".urlencode($var)."\">Click here to go to college page</a>
			</html>
		";
	}
	if(isset($_POST['submit']))
	{
		$submit = mysql_prep(strip_tags($_POST['submit']));
		$college = mysql_prep(strip_tags($_POST['college']));
		if($submit)
		{
			if($college)
			{
				$query = mysql_query("INSERT INTO colleges VALUES ('','$college')");
				echo "College has been added";
				redirect_to("category.php");
			}
		}
	}
?>



<?php include("includes/footer.php"); ?>