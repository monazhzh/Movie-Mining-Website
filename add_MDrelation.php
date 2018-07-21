<!DOCTYPE html>
<html>
<body>
<head>
</head>

<?php include 'menu.php'; ?>
<?php
$movie =  $director = $movie_err = $director_err = "";
// check if required fields are empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["movie"])) {
        $movie_err = "Movie is required";
    }else{
        $movie = $_POST['movie'];
    }
    if (empty($_POST["director"])) {
        $director_err = "Director is required";
    }else{
        $director = $_POST['director'];
    }
}
?>

<h2 style="color:#333;">Add New Movie/Director Relation</h2>
<p><span class="error">* Required field.</span></p>
<form method="post" action="add_MDrelation.php">
    <font class="label">Movie: </font><br/>
    <select name="movie" style="width:500px">
        <option selected="">
            <?php
            $query_movie = "SELECT id,title,year FROM Movie ORDER BY title;";
            // establish and check a connection
            $db = new mysqli('localhost', 'cs143', '', 'CS143');
            if ($db->connect_errno > 0) {
                die('Unable to connect to database [' . $db->connect_error . ']');
            }else{
                $rs_movie = $db->query($query_movie);
            }
            while($mrs = $rs_movie->fetch_array()){
                $title = $mrs['title'];
                $year = $mrs['year'];
                $mid = $mrs['id'];
            ?>
            <option value="<?=$mid?>"><?php echo"$title($year)"?></option>
            <?php
        }
        ?>
    </select>
    <span class="error">* <?php echo "$movie_err";?></span><br/><br/><br/>
    <font class="label">Director: </font><br/>
    <select name="director" style="width:500px">
        <option selected="">
            <?php
            $query_director = "SELECT id,first,last,dob FROM Director ORDER BY first, last;";
            $rs_director = $db->query($query_director);
            while($drs = $rs_director->fetch_array()){
                $first = $drs['first'];
                $last = $drs['last'];
                $dob = $drs['dob'];
                $did = $drs['id'];
            ?>
            <option value="<?=$did?>"><?php echo"$first $last($dob)"?></option>
            <?php
        }
        ?>
    </select>
    <span class="error">* <?php echo "$director_err";?></span><br/><br/><br/>
    <input type="submit" value="Add !"><br/><br/>
</form>

<?php
// insert new tuple into MovieDirector table
if($movie && $director){
    $query_adddirector="INSERT INTO MovieDirector VALUES($movie,$director);";
    $rs_addrole = $db->query($query_adddirector);
    // close connection
    $db->close();
    echo "Successfully add new movie/director relation!";
}
?>

</body>
</html>