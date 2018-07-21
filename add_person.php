<!DOCTYPE html>
<html>
<head>
</head>
<body>

<?php include 'menu.php'; ?>
<?php

$identity = $first = $last = $gender = $dob = $dob = "";
$identity_err = $first_err = $last_err = $gender_err = $dob_err = "";
// check if required fields are empty
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["first"])) {
        $first_err = "First name is required";
    }else{
        $first = $_POST['first'];
        }
    if (empty($_POST["last"])) {
        $last_err = "Last name is required";
    }else{
        $last = $_POST['last'];
    }
    if (empty($_POST["identity"])) {
        $identity_err = "Identity is required";
    }else{
        $identity = $_POST['identity'];
    }
    if (empty($_POST["dob"])) {
        $dob_err = "Date of Birth is required";
    }else{
        $dob = $_POST['dob'];
    }
    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required";
    }else{
        $gender = $_POST['gender'];
    }
    if (empty($_POST["dod"])) {
        $dod = "NULL";
    }else{
        $dod = $_POST['dod'];
    }
}
    
?>

<h2 style="color:#333;">Add New Actor/Director Info</h2>
<p><span class="error">* Required field.</span></p>
<form method="post" action="add_person.php">
     <font class="label">Identity: </font>
     <input type="checkbox" name="identity[]" value="Actor"><font class="label">Actor</font>
     <input type="checkbox" name="identity[]" value="Director"><font class="label">Director</font>
     <span class="error">* <?php echo "$identity_err";?></span><br/><br/>
     <font class="label">First Name: </font><input type="text" name="first" value="">
     <span class="error">* <?php echo "$first_err";?></span><br/><br/>
     <font class="label">Last Name: </font><input type="text" name="last" value="">
     <span class="error">* <?php echo "$last_err";?></span><br/><br/>
     <font class="label">Gender: </font>
     <input type="radio" name="gender" value="Male" checked=""><font class="label">Male</font>
     <input type="radio" name="gender" value="Female"><font class="label">Female</font>
     <span class="error">* <?php echo "$gender_err";?></span><br/><br/>
     <font class="label">Date of Birth: </font>
     <input type="text" name="dob" value=""><font class="note"> ie: 1997-05-05</font>
     <span class="error">* <?php echo "$dob_err";?></span><br/><br/>
     <font class="label">Date of Death: </font>
     <input type="text" name="dod" value=""><font class="note"> (leave blank if alive now)</font><br/><br/>
     <input type="submit" name="submit" class="button" value="Add !">
     <input type="reset" class="button"/><br/><br/>
</form>

<?php
if($identity && $first && $last && $gender && $dob){
    // select the max person ID
    $query="SELECT id FROM MaxPersonID;";
    // establish and check a connection
    $db = new mysqli('localhost', 'cs143', '', 'CS143');
    if ($db->connect_errno > 0) {
        die('Unable to connect to database [' . $db->connect_error . ']');
    }else{
        $maxpersonid = $db->query($query);
        $row = $maxpersonid->fetch_row();
        $id = current($row);
        // update MaxpersonID table and insert new tuple
        if ($maxpersonid) {
            $newid = $id + 1;
            if(in_array('Director',$identity)){
                if($dod == "NULL"){
                $query_insert = "INSERT INTO Director VALUES($newid,'$last','$first','$dob',$dod);";}
                else{
                $query_insert = "INSERT INTO Director VALUES($newid,'$last','$first','$dob','$dod');";}
                $db->query($query_insert);
            }           
            if(in_array('Actor',$identity)){
                if($dod == "NULL"){
                $query_insert = "INSERT INTO Actor VALUES($newid, '$last', '$first', '$gender', '$dob', $dod)";}
                else{
                $query_insert = "INSERT INTO Actor VALUES($newid, '$last', '$first', '$gender', '$dob', '$dod')"; 
                }
                if (!($db->query($query_insert))){
                    $errmsg = $db->error;
                    print "Invalid Input!<br />";
                    exit(1);
                }else{
                    echo "<br> Successfully add new info!";
                }
            }
            $query_maxpersonid = "UPDATE MaxPersonID Set id=$newid;";
            $db->query($query_maxpersonid);
            // close connection
            $db->close();
        }
    }
}
?>

</body>
</html>