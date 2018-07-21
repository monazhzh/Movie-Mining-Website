<?php include 'menu.php'; ?>
<!DOCTYPE html>
<html>
<body>

<head><title>  
Show Actor
</title>  

<h2 style="color:#333;">Actor Information Page:</h2>
<hr>
<form method="post" action="search.php">
<div>
    <input type="hidden" value="on" name="searchmovie"/>
    <input type="hidden" value="on" name="searchactor"/>
</div>
<div>
   <div>
    <input type="text" name="search" style="width:450px;height:30px;font-size:15px;" placeholder="Search...">
    <input type="submit" class="button" value="Search">
    </div>
</form>

<?php
// establish and check a connection
$db = new mysqli('localhost', 'cs143', '', 'CS143');
if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //if checkbox "searchmovie is on"
    if($_REQUEST["searchmovie"] != ""){
        $searchname = $_REQUEST["search"];
        //search by name, not sensitive
        $query = "select * from Movie where title like '%$searchname%' order by title";
        if (!($rs = $db->query($query))){ 
            $errmsg = $db->error;
            print "Query failed: $errmsg <br />";
            exit(1);
        }else{
            echo "<h4>Movie matches \"$searchname\": (Total results: $rs->num_rows)<br></h4>";
            echo "<table class=\"Actortable table table-striped\">";
            echo "<tr><th>ID</th><th>title</th><th>year</th><th>rating</th><th>company</th></tr>";
            while($row = $rs->fetch_array()) {
                echo "<tr><td>{$row['id']}</td><td><a href=\"browse_movie.php?mid={$row['id']}\">{$row['title']}</a></td><td>{$row['year']}</td><td>{$row['rating']}</td><td>{$row['company']}</td></tr>";
            }
            echo "</table>";
        }
    }
    if($_REQUEST["searchactor"] != ""){
        $searchname = $_REQUEST["search"];
        //search by name, not case-sensitive
        $query = "select * from Actor where  concat(first,' ',last) like '%$searchname%' order by id";
        if (!($rs = $db->query($query))){ 
            $errmsg = $db->error;
            print "Query failed: $errmsg <br/>";
            exit(1);
        }else{
            echo "<h4>Actor/Actress matches \"$searchname\": (Total results: $rs->num_rows)<br></h4>";
            echo "<table class=\"Actortable table table-striped\">";
            echo "<tr><th>ID</th><th>name</th><th>sex</th><th>dob</th><th>dod</th></tr>";
            while($row = $rs->fetch_array()) {
                if(empty($row['dod'])){
                    $row['dod'] = "N/A";
                }
                echo "<tr><td>{$row['id']}</td><td><a href=\"browse_actor.php?aid={$row['id']}\">{$row['first']} {$row['last']}</a></td><td>{$row['sex']}</td><td>{$row['dob']}</td><td>{$row['dod']}</td>";
            }
            echo "</table>";
        }
    }
    
    
}
?>
</div>
</body>
</html>