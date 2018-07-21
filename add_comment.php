<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html>
<body>
<head>
</head>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
   
	    if (empty($_POST["movie"])) {
	    	$movieErr = "Movie is required";
	    }else{
	    	$movie = $_POST['movie'];
	    }
		if (empty($_POST["name"])) {
			$nameErr = "Name is required";
			// $name = "NULL";
		}else{
			$name = $_POST['name'];
		}
		if (empty($_POST["rating"])) {
			$rating = "NULL";
		}else{
			$rating= $_POST['rating'];
		}
		if (empty($_POST["comments"])) {
			$comments = "NULL";
		}else{
			$comments= $_POST['comments'];
		}
	}
	
?>

<h2 style="color:#333;"> Add New Comment:</h2>
<p><span class="error">* Required field.</span></p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<font class="label">Movie:<SELECT name="movie" style="width:500px">
	<OPTION SELECTED>
	<?php
	$sqlmovie="SELECT id,title,year FROM Movie ORDER BY title;";
	$db = new mysqli('localhost', 'cs143', '', 'CS143');
	if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }else{
		$query_selectmovie = $db->query($sqlmovie);
	}
	while($resultmovie=$query_selectmovie->fetch_array()){
		$mtitle=$resultmovie['title'];
		$myear=$resultmovie['year'];
		$movieid=$resultmovie['id'];	
	?>	
	<OPTION value="<?=$movieid?>"><?php echo"$mtitle($myear)"?></OPTION>	
	<?php
	}
	?>
	</SELECT>
	<span class="error">* <?php echo "$movieErr";?></span><br/><br/>

	<font class="label">Your Name:<input type="text" name="name" style="width:450px;height:30px;font-size:15px;" placeholder="Your name">
	<span class="error">* <?php echo "$nameErr";?></span><br/><br/>
	<font class="label">Rating:<SELECT name="rating" sytle="width:100px">
	<OPTION value="5" SELECTED>5 - Highly recommened</OPTION>
	<OPTION value="4"> 4 - Good</OPTION>
	<OPTION value="3">3 - It's ok</OPTION>
	<OPTION value="2">2 - Not my cup of tea</OPTION>
	<OPTION value="1">1 - Terrible</OPTION>
	</SELECT><br/><br/>
	Comments:<br/><br/>
	<textarea type="textarea" cols="60" rows="10" name="comments" style="font-size:15px;" placeholder="Your comments"></textarea><br/><br/>
	<input type="submit" name="submit" class="button" value="Add !">
    <input type="reset" class="button"/><br/><br/>

</form>

<?php
	/*insert the new tuple into Review*/
	if($movie && $name){
		$sql_time="SELECT now()";
		$time=$db->query($sql_time);
		$curtimestamp=$time->fetch_array();	
		$query_insertreview="INSERT INTO Review VALUES('$name','$curtimestamp[0]',$movie,$rating,'$comments');";
		if(!($rs_addrole = $db->query($query_insertreview))){
			$errmsg = $db->error;
            print "Same username can only comment once!<br />";
            exit(1);
		}else{
			echo "Successfully add new review!";
		}
		$db->close();
	}
?>
</body>
</html>