<!DOCTYPE html>
<html>
<body>
<head>
</head>

<?php include 'menu.php'; ?>
<?php
$movie =  $actor = $role = "";
$movie_err = $actor_err = $role_err = "";
// check if required fields are empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["movie"])) {
        $movie_err = "Movie is required";
    }else{
        $movie = $_POST['movie'];
    }
    if (empty($_POST["actor"])) {
        $actor_err = "Actor is required";
    }else{
        $actor = $_POST['actor'];
    }
    if (empty($_POST["role"])) {
        $role_err = "Role is required";
    }else{
        $role = $_POST['role'];
    }
}
?>

<h2 style="color:#333;">Add New Movie/Actor Relation</h2>
<p><span class="error">* Required field.</span></p>

<form method="post" action="add_MArelation.php">
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
    <font class="label">Actor: </font><br/>
    <select name="actor" style="width:500px">
        <option selected="">
            <?php
            $query_actor="SELECT id,first,last,dob FROM Actor ORDER BY first, last;";
            $rs_actor = $db->query($query_actor);
            while($ars = $rs_actor->fetch_array()){
                $first = $ars['first'];
                $last = $ars['last'];
                $dob = $ars['dob'];
                $aid = $ars['id'];
            ?>
            <option value="<?=$aid?>"><?php echo"$first $last($dob)"?></option>
            <?php
        }
        ?>
    </select>
    <span class="error">* <?php echo "$actor_err";?></span><br/><br/><br/>
    <font class="label">Role: </font><br/>
    <input type="text" name="role" style="width:500px;height:30px;font-size:15px;" placeholder="Role">
    <span class="error">* <?php echo "$roleErr";?></span><br/><br/><br/>
    <input type="submit" class="button" value="Add !"><br/><br/>
</form>

<?php
// insert new tuple into MovieActor table
if($movie && $actor && $role){
    $query_addrole="INSERT INTO MovieActor VALUES($movie,$actor,'$role');";
    $rs_addrole = $db->query($query_addrole);
    // close connection
    $db->close();
    echo "Successfully add new movie/actor relation!";
}
?>

</body>
</html>