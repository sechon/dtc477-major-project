<?
//Spencer Echon
//DTC 477 Major Project

// Adapted from Tor deVries Patient database demo
// This page lists all the current records in the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';


// did one or more checked boxes get submitted? let's delete them
if (isset($_POST["song"])) {
	$songList = $_POST["song"];
	foreach ($songList as $songID) {
		$sql = "DELETE FROM $databaseTable
						WHERE songid=$songID";
		$result = $db->query($sql);
		if (!$result) die("Delete Error: " . $sql . "<br>" . $db->error);
	}
}

// select all columns (*) in the database
$sql = "SELECT * FROM $databaseTable
				ORDER BY songid"; 
$result = $db->query($sql);
if (!$result) die("Select Error: " . $sql . "<br>" . $db->error);

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

	//echo outputSongResults($result); // call the function that outputs a table
	
}

// onward to the HTML!
?>

  <!DOCTYPE html>
  <html>

  <head>

    <!-- meta tags and title -->
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">Music Manager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="add-song.php">Add Song</a>
          </li>

          <form method='POST'>
            <button class="nav-link" type="submit">Delete Checked</button>
          </form>
        </ul>
        <form class="form-inline my-2 my-lg-0" method='POST'>
          <input class="form-control mr-sm-2" name="searchText" type="searchText" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div class="container">
      <form method='POST'>
        <?= outputSongResults($result, true); // call the function that returns HTML for a table
        ?>
      </form>
    </div>

  </body>

  </html>