<!DOCTYPE html>
<html>
<head>
</head> 
<body>

<?php include 'menu.php'; ?>
<?php
// establish and check a connection
$db = new mysqli('localhost', 'cs143', '', 'CS143');
if ($db->connect_errno > 0) {
    die('Unable to connect to database [' . $db->connect_error . ']');
}else{
    if($_GET['mid']){
        $query_movie = 'SELECT * FROM Movie WHERE id ='.$_GET['mid'];
        $rs_movie = $db->query($query_movie);

        $query_moviedirector = 'SELECT concat_ws(" ",first,last) AS fullname,dob FROM Director,(SELECT did FROM MovieDirector WHERE mid = '.$_GET['mid'].') as T WHERE Director.id = T.did;';
        $rs_moviedirector = $db->query($query_moviedirector);

        $query_moviegenre = 'SELECT genre FROM MovieGenre WHERE mid ='.$_GET['mid'];
        $rs_moviegenre = $db->query($query_moviegenre);

        $query_role = 'SELECT concat_ws(" ",first,last) AS fullname,role,id FROM (SELECT aid,role FROM MovieActor WHERE mid = '.$_GET['mid'].') as Role,Actor WHERE Actor.id = Role.aid;';
        $rs_role = $db->query($query_role);

        $query_review = 'SELECT * FROM Review WHERE mid = '.$_GET['mid'];
        $rs_review = $db->query($query_review);

        $query_score = 'SELECT avg(rating) FROM Review WHERE mid = '.$_GET['mid'];
        $rs_score = $db->query($query_score);
        
        $query_reviewnumber = 'SELECT count(*) FROM Review WHERE mid = '.$_GET['mid'];
        $rs_reviewnumber = $db->query($query_reviewnumber);

        $movie_info = $rs_movie->fetch_assoc();
        $movie_score = $rs_score->fetch_row();
        $movie_reviewnum = $rs_reviewnumber->fetch_row();
    }
}  
// close connection
$db->close();
?>  

<h2 style="color:#333;">Movie Information: </h2>
<font class="label">Title: <?php echo $movie_info['title'].'('.$movie_info['year'].')';?></font><br/>
<font class="label">Producer: <?php echo $movie_info['company'];?></font><br/>
<font class="label">MPAA Rating: <?php echo $movie_info['rating'];?></font><br/>
<font class="label">Director: 
<?php
    $comma = FALSE;
    while($moviedirector = $rs_moviedirector->fetch_assoc()){
        if($comma){
            echo ', ';
        }else{
            $comma = TRUE;
        }
        echo $moviedirector['fullname'].'('.$moviedirector['dob'].')';
    }
?></font><br/>
<font class="label">Genre: 
<?php
    $comma = FALSE;
    while($moviegenre = $rs_moviegenre->fetch_assoc()){
        if($comma){
            echo ', ';
        }else{
            $comma = TRUE;
        }
        echo $moviegenre['genre'];
    }
?></font>

<h2 style="color:#333;">Actor in this movie: </h2>
<font class="label">
<?php
echo "<table class=\"Actortable table table-striped\">";
echo "<tr><th>Actor</th><th>Role</th></tr>";
while($role = $rs_role->fetch_assoc()){
    echo "<tr><td><a href=\"browse_actor.php?aid={$role['id']}\">{$role['fullname']}</a></td><td>{$role['role']}</td>";
}
echo "</table>";
?></font>

<h2 style="color:#333;">User Review: </h2>
<font class="label">
<?php
if($movie_review = $rs_review->fetch_assoc()){
    echo 'Average Score: ';
    echo $movie_score[0].'/5';
    echo '<br>';
    echo 'Total commented by '.$movie_reviewnum[0].' reviews(s).';
    echo '<a href="add_comment.php">  Add your review now !</a><br/><br/>';
    echo 'All Comments in Details:<br/>';
    echo "<table class=\"Actortable table table-striped\">";
    echo "<tr><th>Time</th><th>Username</th><th>Rating</th><th>Comment</th></tr>";
    do{
        echo "<tr><td>{$movie_review['time']}</td><td>{$movie_review['name']}</td><td>{$movie_review['rating']}</td><td>{$movie_review['comment']}</td>";

    }while($movie_review = $rs_review->fetch_assoc());
    echo "</table>";
}else{
    echo ' (Sorry, no review for this movie)';
    echo '<a href="add_comment.php">  Add your review now!!</a><br/>';
}
?></font>

<hr/>
<font class="label"><a href="search.php">Search for other actors/movies: Click me !</a></font>

</body>
</html>