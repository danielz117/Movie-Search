<html>
        <h1>
	  Actor Page:
	</h1>
	<hr>
	<h2>
	  Actor Information:
	</h2>
</html>
<?php
if(! $_GET["id"]) {
exit();
}

 $db = new mysqli('localhost', 'cs143', '', 'class_db');
 if ($db->connect_errno > 0) {
die('Unable to connect to database [' . $db->connect_error . ']');
}
$id = $_GET['id'];
$queryInfo = "SELECT id, first, last, sex, dob, dod 
	      FROM Actor
	      WHERE id = $id"; 
$query = "SELECT * 
	  FROM Movie";
$rs1 = $db->query($queryInfo);

if($row = $rs1->fetch_assoc()) {
$first = $row['first'];
$last = $row['last'];
$sex = $row['sex'];
$dob = $row['dob'];
$dod = $row['dod'];
print "$first $last, $sex, $dob, $dod<br>";
}

echo "<h2>
      Actor's Movies and Roles
      </h2>";

$queryMovieRole = "SELECT Movie.title, ma.role, Movie.id
FROM Movie, (SELECT mid,role FROM MovieActor WHERE $id = aid) ma
WHERE Movie.id = ma.mid";
$rs2 = $db->query($queryMovieRole);
while($row = $rs2->fetch_assoc()) {
$role = $row['role'];
$title = $row['title'];
$Mid = $row ['id'];
print "$role, ";
echo "<a href=\"movie.php?id=$Mid\">$title</a>";
print "<br>";
}
?>
