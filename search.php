<?

// This page offers a form that submits back to itself to search for records in the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';

// get search value from the submitted POST array
$search = $_POST["searchText"];

if ($search != "") {

	// select all columns (*) in rows where the $search appears in 
	// patient_name OR patient_complaint OR physician_name
	$sql = "SELECT * FROM $databaseTable
					WHERE song_name LIKE '%$search%'
					OR song_artist LIKE '%$search%' 
					OR song_album LIKE '%$search%'
					ORDER BY songid"; 
	$result = $db->query($sql);
	if (!$result) die("Select Error: " . $sql . "<br>" . $db->error);

	echo outputSongResults($result); // call the function that outputs a table
	
}

// onward to the HTML!

?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Manager</title>

    <!-- external and internal CSS -->
    <link rel="stylesheet" href="styles.css" media="all">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <style>
      /* in-file CSS here */
    </style>

    <!-- external and internal JavaScript -->
    <script src="scripts.js" defer></script>
    <!-- bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      // in-page JavaScript here
    </script>
</head>
<body>

<form method="POST">
	<table>
		<tr>
			<td>Search for:</td>
			<td><input id="searchText" name="searchText" type="text"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit">Search</button></td>
		</tr>
	</table>
</form>
<ul>
	<li><a href="add-song.php">Add Song</a></li>
	<li><a href="index.php">Read Music Manager</a></li>
	<li><a href="search.php">Search Songs</a></li>
</ul>


</body>
</html>