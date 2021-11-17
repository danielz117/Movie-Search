<html>
	<h1>
	Search Page:
	</h1>
</html>

<?php if(!($_GET["actor"]) && !($_GET["movie"])) : ?>
<form method="GET">
  <label for="actor">Actor:</label><br>
  <input type="text" id="actor" name="actor"><br>
<input type="submit" value="Search Actor"><br>
</form>
<form method="GET">
  <label for="movie">Movie:</label><br>
  <input type="text" id="movie" name="movie"><br>
    <input type="submit" value="Search Movie">
  </form>
  <?php endif; ?>

<?php if($_GET["actor"]) {

$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
die('Unable to connect to database [' . $db->connect_error . ']');
}
$words = $_GET['actor'];
if (strpos($words, ' ') !== false) {
	$words = explode(" ", $words);
	$queryNonCase = "SELECT first, last ,id
		         FROM Actor
			 WHERE LOWER(CONCAT(first, last)) LIKE LOWER('%$words[0]%')
			AND LOWER(CONCAT(first, last)) LIKE LOWER('%$words[1]%')";
}
else {
$queryNonCase = "SELECT first, last ,id
		FROM Actor
		WHERE LOWER(CONCAT(first, last)) LIKE LOWER('%$words%')";
}
$rs1 = $db->query($queryNonCase);

while($row = $rs1->fetch_assoc()) {
	$first = $row['first'];
	$last = $row['last'];
	$aid = $row['id'];
	echo "<a href=\"actor.php?id=$aid\">$first $last</a><br>";
}

}
else if ($_GET["movie"]) {
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) {
die('Unable to connect to database [' . $db->connect_error . ']');
}
$words = $_GET['movie'];
if (strpos($words, ' ') !== false) {
$words = explode(" ", $words);
        $queryNonCase = "SELECT title,id
                         FROM Movie
                         WHERE LOWER(title) LIKE LOWER('%$words[0]%')
                         AND LOWER(title) LIKE LOWER('%$words[1]%')";
}
else {
$queryNonCase = "SELECT title,id
                FROM Movie
                WHERE LOWER(title) LIKE LOWER('%$words%')";
}
$rs1 = $db->query($queryNonCase);

while($row = $rs1->fetch_assoc()) {
$title = $row['title'];
$mid = $row['id'];
echo "<a href=\"movie.php?id=$mid\">$title</a><br>";
}
}

