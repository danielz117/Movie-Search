<html>
        <h1>
          Movie Page:
        </h1>
        <hr>
        <h2>
          Movie Information:
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
$queryInfo = "SELECT title, year, rating, company
              FROM Movie 
              WHERE id = $id";
$rs1 = $db->query($queryInfo);

if($row = $rs1->fetch_assoc()) {
$title = $row['title'];
$company = $row['company'];
$rating = $row['rating'];
$year = $row['year'];
print "$title, $company, $rating, $year<br>";
}

echo "<h2>
      Actors in the Movie
      </h2>";

$queryActor = "SELECT Actor.first, Actor.last, Actor.id
FROM Actor, (SELECT aid, role FROM MovieActor WHERE $id = mid) ma
WHERE Actor.id = ma.aid";
$rs2 = $db->query($queryActor);
while($row = $rs2->fetch_assoc()) {
$first = $row['first'];
$last = $row['last'];	
$Aid = $row['id'];
echo "<a href=\"actor.php?id=$Aid\">$first $last</a>";
print "<br>";
}

echo "<hr>
	<h2> Average Score: </h2>";
$queryScore = "SELECT AVG(rating) avgRating
		FROM Review
		WHERE mid = $id";
$rs3 = $db->query($queryScore);
if($row = $rs3->fetch_assoc()) {
	$avgscore = $row['avgRating'];
	print "$avgscore<br><br>";
}

echo "<h2> Reviews: </h2>";
$queryReviews = "SELECT name,rating,comment,time
		FROM Review
		WHERE mid=$id";
$rs4 = $db->query($queryReviews);
while($row = $rs4->fetch_assoc()) {
	$name = $row['name'];
	$rating = $row['rating'];
	$comment = $row['comment'];
	$time = $row['time'];
	print "$name, $rating, $comment, $time<br>";
}
print "<br>";
echo "<a href=\"review.php?id=$id\">add Comment</a>";
?>

