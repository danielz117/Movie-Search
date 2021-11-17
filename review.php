<html>
        <h1>
	          Add new review here:
	</h1>
	 <hr>
</html>
<?php if($_GET["id"]) : ?>
	<form method="GET">
		<label for="mid">Movie ID:</label><br>
		<input type="text" value=<?php echo $_GET["id"]; ?> name="mid"><br>
		<label for="name">Name:</label><br>
		<input type="text" id="name" name="name"><br>
	<p> Choose your rating:</p>
		<form method="GET">
		<input type="radio" id="one" name="rating" value="1">
		<label for="one">1</label><br>
		<input type="radio" id="two" name="rating" value="2">
                <label for="two">2</label><br>
		<input type="radio" id="one" name="rating" value="3">
                <label for="three">3</label><br>
		<input type="radio" id="one" name="rating" value="4">
                <label for="four">4</label><br>
		<input type="radio" id="one" name="rating" value="5">
		<label for="five">5</label><br>
		<br>	
		<label for="comment">Comments:</label><br>
		<input type="text" id="comment" name="comment"><br>
		
		<input type="submit" value="Submit">		
		</form>
<?php endif; ?>
<?php if(isset($_GET["mid"]) && isset($_GET["name"]) && isset($_GET["rating"]) && isset($_GET["comment"])) {
$db = new mysqli('localhost', 'cs143', '', 'class_db');
if ($db->connect_errno > 0) { 
	    die('Unable to connect to database [' . $db->connect_error . ']'); 
}

$query = "INSERT INTO Review (name,time,mid,rating,comment) VALUES ('".$_GET["name"]."',CURRENT_TIMESTAMP,'".$_GET["mid"]."','".$_GET["rating"]."','".$_GET["comment"]."')";
if ($db->query($query) === TRUE) {
	  echo "Confirmation Text: New review created successfully";
} else {
	  echo "Error: " . $query . "<br>" . $db->error;
}
$db->commit();
}
?>
