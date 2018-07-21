<!DOCTYPE html>
<html>
<head>
<style>
header {background-color:gold; color:black; text-align:center;padding:10px;}
select {width:200px;height:30px;appearance:none;-moz-appearance:none;-webkit-appearance:none;font-size:16px;font-family:verdana;color:#333;}
.main{text-align:left;background-color:#f1f1f1;border-radius:10px;width:60%;position:absolute;left:50%;top:60%;transform: translate(-50%,-50%);}
.error {color:#FF0000;}
.label {font-size:15px;font-family:verdana;color:#333;}
.note {font-size:12px;font-family:verdana;color:#333;}
nav {list-style-type:none;margin:0;padding:0;overflow:hidden;background-color:#333;}
li {float:left;}
li a, .dropbtn{display:inline-block;color:white;text-align:center;padding:14px 16px;text-decoration:none;}
li a:hover, .dropdown:hover, .dropbtn{background-color:#333;}
.dropdown {display:inline-block;}
.dropdown-content {display:none;position:absolute;background-color:#f9f9f9;min-width:160px;box-shadow:0px 8px 16px 0px rgba(0,0,0,0.2);}
.dropdown-content a {color:black;padding:12px 16px;text-decoration:none;display:block;}
.dropdown-content a:hover {background-color: #f1f1f1}
.dropdown:hover .dropdown-content{display:block;}
table {border-collapse: collapse;width: 100%;}
th, td {padding: 8px;text-align: left;border-bottom: 1px solid #ddd;}
tr:hover {background-color:#f5f5f5;}
.button {
    border-radius:5px;
    background-color: #f5f5f5;
    color: black;
    border: 2px ;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
}
.button:hover {
    background-color: #555555;
    color: white;
}
</style>
</head>

<body>
<header><h1 style="font-family:verdana">IMDb Movie Mining</h1></header>

<nav>
  <li><a href="home.php">Home</a></li>
  <div class="dropdown">
    <a href="#" class="dropbtn">Add New Content</a>
    <div class="dropdown-content">
      <a href="add_person.php">Actor/Director Info</a>
      <a href="add_movie.php">Movie Info</a>
      <a href="add_comment.php">Movie Comments</a>
      <a href="add_MArelation.php">Movie/Actor Relation</a>
      <a href="add_MDrelation.php">Movie/Director Relation</a>
    </div>
  </div>
  <div class="dropdown">
    <a href="#" class="dropbtn">Browse Content</a>
    <div class="dropdown-content">
      <a href="show_actor.php">Actor Info</a>
      <a href="show_movie.php">Movie Info</a>
    </div>
  </div>
  <li><a href="search.php">Search</a></li>
</nav>

</body>
</html>
