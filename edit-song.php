<?

// This page offers a form that submits back to itself to insert new records into the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';

// read submitted data from the $_POST array
$songName = mysqli_real_escape_string($db, $_POST["addSongName"]);
$songArtist = mysqli_real_escape_string($db, $_POST["addArtistName"]);
$songAlbum = mysqli_real_escape_string($db, $_POST["addAlbumName"]);
$songRating = mysqli_real_escape_string($db, $_POST["addRating"]);
$songVideo = mysqli_real_escape_string($db, $_POST["addVideo"]);


if ( ($songName != "") && ($songArtist != "") && ($songAlbum != "") && ($songRating != "") && ($songVideo != "") ) {

	// insert submitted information into the database
	// ideally we would analyze the info first to confirm it is accurate, but let's live dangerously
	// but we did use mysqli_real_escape_string() above for security reasons
	$sql = "INSERT INTO $databaseTable (song_name, song_artist, song_album, song_rating, song_video)
					VALUES ( '$songName', '$songArtist', '$songAlbum', '$songRating', '$songVideo' )";
	
	$result = $db->query($sql); // process the SQL logic above, and get a result back
	
	if (!$result) die("Insert Error: " . $sql . "<br>" . $db->error);
	
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
			<td>Song Name:</td>
			<td><input id="addSongName" name="addSongName" type="text"></td>
		</tr>
		<tr>
			<td>Artist Name:</td>
			<td><input id="addArtistName" name="addArtistName" type="text"></td>
		</tr>
		<tr>
			<td>Album Name:</td>
			<td><input id="addAlbumName" name="addAlbumName" type="text"></td>
		</tr>
		<tr>
			<td>Rating:</td>
			<td><select name="addRating" id="addRating">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select></td>
		</tr>
    <tr>
			<td>Video URL:</td>
			<td><input id="addVideo" name="addVideo" type="url"></td>
		</tr>
		<tr>
			<td colspan="2"><button type="submit">Add Song</button></td>
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