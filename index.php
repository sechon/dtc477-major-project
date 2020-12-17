<?
//Spencer Echon
//DTC 477 Major Project

// Adapted from Tor deVries Patient database demo
// This page lists all the current records in the database

// require the database initialization and functions
require 'database.php';
require 'functions.php';

//buffer reset - https://stackoverflow.com/questions/6974691/php-page-redirect-problem-cannot-modify-header-information
ob_start();

// select all columns (*) in the database
$sql = "SELECT * FROM $databaseTable
				ORDER BY songid"; 
$result = $db->query($sql);
if (!$result) die("Select Error: " . $sql . "<br>" . $db->error);

// did one or more checked boxes get submitted? let's delete them
if (isset($_POST['deleteSelected'])) {
	$songList  = $_POST['song'];
  if (is_array($songList) || is_object($songList)){
    foreach ($songList as $songID) { 
      $sql = "DELETE FROM $databaseTable
              WHERE songid=$songID";
      $result = $db->query($sql);
      if (!$result) die("Delete Error: " . $sql . "<br>" . $db->error);
      echo '<script>alert("Delete Successful")</script>';
      header("Refresh:0");
    }
  }
}

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
}
?>

  <!DOCTYPE html>
  <html>

  <head>

    <!-- meta tags and title -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music Manager</title>
    
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="favicon.ico"/>

    <!-- external and internal CSS -->
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" media="all">

    <!-- external and internal JavaScript -->
    <!-- bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </head>

  <body>
    <!-- start top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand" href="index.php">Music Manager</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="btn btn-inverse btn-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-inverse btn-link" href="add-song.php">Add Song</a>
          </li>
          <!-- start form -->
          <form method="POST">
            <button class="btn btn-inverse btn-link" id="deleteSelected" name="deleteSelected" type="submit">Delete Checked</button>
            <!-- playlist feature disabled/not implemented yet-->
            <button type="button" class="btn btn-inverse btn-link" disabled>Playlist</button>
        </ul>
        <div class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" name="searchText" type="searchText" placeholder="Search" aria-label="Search">
          <button class="btn btn-primary my-2 my-sm-0 shadow-custom" id="search-btn" type="submit">Search</button>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="table-responsive">
        <?= outputSongResults($result, true); // call the function that returns HTML for a table
        ?>
          </form> <!-- end form outside of nav to include output results -->
          </table>
      </div>
    </div>

  </body>

  </html>