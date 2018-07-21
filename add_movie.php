<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html>
<body>
<head>
</head>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {	
   
	    if (empty($_POST["title"])) {
	    	$titleErr = "Title is required";
	    }else{
	    	$title = $_POST['title'];
	    }
		if (empty($_POST["company"])) {
			$company = "NULL";
		}else{
			$company = $_POST['company'];
		}
		if (empty($_POST["year"])) {
			$year = "NULL";
		}else{
			$year = $_POST['year'];
		}
		if (empty($_POST["rating"])) {
			$rating = "NULL";
		}else{
			$rating = $_POST['rating'];
		}
		if (empty($_POST["genre"])) {
			$genreErr = "Genre is required";
		}else{
			$genre = $_POST['genre'];
		}
	}
	
?>

<h2 style="color:#333;"> Add New Movie Info:</h2>
<p><span class="error">* Required field.</span></p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
	<font class="label">Title: </font><input type="text" name="title" value="">
	<span class="error">* <?php echo "$titleErr";?></span><br/><br/>
	<!-- Company: <input type="text" name="company"><br/><br/> -->
	<font class="label">Company: </font><input type="text" name="company" value=""><br/><br/>
	<font class="label">Year: </font><input type="text" name="year" value=""><br/><br/>
	<font class="label">MPAA Rating:<SELECT NAME="rating" style="width:100px">
				<OPTION value="G" SELECTED>G
				<OPTION value="NC-17">NC-17
				<OPTION value="PG">PG
				<OPTION value="PG-13">PG-13
				<OPTION value="R">R
				<OPTION value="surrendere">surrendere
				</SELECT><br/><br/>
	<font class="label">Genre: <br/>
	<input type="checkbox" name="genre[]" value="Action">Action
	<input type="checkbox" name="genre[]" value="Adult">Adult
	<input type="checkbox" name="genre[]" value="Adventure">Adventure
	<input type="checkbox" name="genre[]" value="Animation">Animation
	<input type="checkbox" name="genre[]" value="Comedy">Comedy
	<input type="checkbox" name="genre[]" value="Crime">Crime
	<input type="checkbox" name="genre[]" value="Documentary">Documentary
	<input type="checkbox" name="genre[]" value="Drama">Drama
	<input type="checkbox" name="genre[]" value="Family">Family<br/>
	<input type="checkbox" name="genre[]" value="Fantasy">Fantasy
	<input type="checkbox" name="genre[]" value="Horror">Horror
	<input type="checkbox" name="genre[]" value="Musical">Musical
	<input type="checkbox" name="genre[]" value="Mystery">Mystery
	<input type="checkbox" name="genre[]" value="Romance">Romance
	<input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi
	<input type="checkbox" name="genre[]" value="Short">Short
	<input type="checkbox" name="genre[]" value="Thriller">Thriller
	<input type="checkbox" name="genre[]" value="War">War
	<input type="checkbox" name="genre[]" value="Western">Western
	<span class="error">* <?php echo "$genreErr";?></span><br/><br/>
	<input type="submit" name ="submit" class="button" value="Add !">
	<input type="reset" class="button"/><br/><br/>

</form>



<?php
	if($title && $genre){
		// select the max movie ID
		$query="SELECT id FROM MaxMovieID;";
		// establish and check a connection
		$db = new mysqli('localhost', 'cs143', '', 'CS143');
		if ($db->connect_errno > 0) {
        	die('Unable to connect to database [' . $db->connect_error . ']');
    	}else{
	 		$maxmovieid = $db->query($query);	
	 		$row = $maxmovieid->fetch_row();
	 		$id=current($row);
		  	if($maxmovieid){
		  		$newid = $id + 1;
		  		if($company=="NULL"){
		  		$query_addmovie="INSERT INTO Movie VALUES($newid,'$title',$year,'$rating',$company);";}
		  		else{
		  		$query_addmovie="INSERT INTO Movie VALUES($newid,'$title',$year,'$rating','$company');";
		  		}
				$db->query($query_addmovie);
				// update the MaxMovieID table
				$query_maxmovieid="UPDATE MaxMovieID Set id=$newid;";
				$db->query($query_maxmovieid);
		
				if(in_array('Action',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Action');";	
					$db->query($query_insert);
				}	  		
				if(in_array('Adult',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Adult');";	
					$db->query($query_insert);
				}
				if(in_array('Adventure',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Adventure');";	
					$db->query($query_insert);
				}
				if(in_array('Animation',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Animation');";	
					$db->query($query_insert);
				}
				if(in_array('Comedy',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Comedy');";	
					$db->query($query_insert);
				}
				if(in_array('Crime',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Crime');";	
					$db->query($query_insert);
				}
				if(in_array('Documentary',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Documentary');";	
					$db->query($query_insert);
				}
				if(in_array('Drama',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Drama');";	
					$db->query($query_insert);
				}
				if(in_array('Family',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Family');";	
					$db->query($query_insert);
				}
				if(in_array('Fantasy',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Fantasy');";	
					$db->query($query_insert);
				}
				if(in_array('Horror',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Horror');";	
					$db->query($query_insert);
				}
				if(in_array('Musical',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Musical');";	
					$db->query($query_insert);
				}
				if(in_array('Mystery',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Mystery');";	
					$db->query($query_insert);
				}
				if(in_array('Romance',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Romance');";	
					$db->query($query_insert);
				}
				if(in_array('Sci-Fi',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Sci-Fi');";	
					$db->query($query_insert);
				}
				if(in_array('Short',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Short');";	
					$db->query($query_insert);
				}
				if(in_array('Thriller',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Thriller');";	
					$db->query($query_insert);
				}
				if(in_array('War',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'War');";	
					$db->query($query_insert);
				}
				if(in_array('Western',$genre)){
					$query_insert="INSERT INTO MovieGenre VALUES($newid,'Western');";	
					$db->query($query_insert);
				}
		
				$db->close();															   
				echo "<br> Successfully add new info!";				
	 		}
	 		
	  	}
  	}
?>
</body>
</html>