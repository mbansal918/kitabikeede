

<!-- like button -->



<div id="fb-root"></div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>

<label id="sig">
  <center><a>kitabikeede<i>Kitabikeede is an interface to buy/sell book.<br />Developed by DA-IICT students<br />
    <img src="img/foot.jpg"> </i></a></center>
    <div style="margin-left:1150px" class="fb-like" data-href="https://www.facebook.com/kitabikeede" data-width="20px" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
</label>

</html>

<?php
	//closing the database connection
	if(isset($connection))
	{
		mysql_close($connection);
	}	
?>

