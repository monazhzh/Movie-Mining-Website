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
    if( $_GET['aid']){
        $query_actor = 'SELECT * FROM Actor WHERE id ='.$_GET['aid'];
        $rs_actor = $db->query($query_actor);

        $query_actormovie = 'SELECT title,role,id FROM (SELECT mid,role FROM MovieActor WHERE aid = '.$_GET['aid'].') AS Role,Movie WHERE Movie.id = Role.mid;';
        $rs_actormovie = $db->query($query_actormovie);

        $actor_info = $rs_actor->fetch_assoc();
    }
}
// close connection
$db->close();
?>  

<h2 style="color:#333;">Actor Information: </h2>
<font class="label">Name: <?php echo $actor_info['first'].' '.$actor_info['last'];?></font><br/>
<font class="label">Gender: <?php echo $actor_info['sex'];?></font><br/>
<font class="label">Date of Birth: <?php echo $actor_info['dob'];?></font><br/>
<font class="label">Date of Death: 
<?php
    if($actor_info['dod']){
        echo $actor_info['dod'];
    }else{
        echo 'Still Alive';
    }
?></font>

<h2 style="color:#333;">Filmography: </h2>
<font class="label">
<?php
echo "<table class=\"Actortable table table-striped\">";
echo "<tr><th>Role</th><th>Movie</th></tr>";
while($actormovie = $rs_actormovie->fetch_assoc()){
    echo "<tr><td>{$actormovie['role']}</td><td><a href=\"browse_movie.php?mid={$actormovie['id']}\">{$actormovie['title']} </a></td>";
}
echo "</table>";
?></font>

<hr/>
<font class="label"><a href="search.php">Search for other actors/movies: Click me !</a></font>


</body>
</html>